@if(isset($message))
   @foreach($message as $msg)
      <div class="message">
         <span>{{ $msg }}</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
   @endforeach
@endif
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>SMART TECH</title>
   <link rel="stylesheet" href="{{ asset('css/style.css') }}">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>

<header class="header">
   <section class="flex">

      <b><a href="{{ url('/') }}" class="logo">SMART TECH</a></b>

      <nav class="navbar">
         <a href="{{ url('menu') }}">Sản phẩm</a>
         <a href="{{ url('orders') }}">Đơn hàng</a>
         <a href="{{ url('contact') }}">Liên hệ</a>
      </nav>

      <div class="icons">
         @php
            use Illuminate\Support\Facades\DB;
            $total_cart_items = 0;
            if (isset($user_id) && $user_id) {
               $total_cart_items = DB::table('cart')->where('user_id', $user_id)->count();
            }
         @endphp

         <a href="{{ url('search') }}"><i class="fas fa-search"></i></a>
         <a href="{{ url('cart') }}">
            <i class="fas fa-shopping-cart"></i>
            <span>({{ $total_cart_items }})</span>
         </a>
         <div id="user-btn" class="fas fa-user"></div>
         <div id="menu-btn" class="fas fa-bars"></div>
      </div>

      <div class="profile">
         @php
            $user = null;
            if (isset($user_id) && $user_id) {
               $user = DB::table('users')->where('id', $user_id)->first();
            }
         @endphp

         @if($user)
            <p class="name">{{ $user->name }}</p>
            <div class="flex">
               <a href="{{ url('profile') }}" class="btn">Thông tin</a>
               <a href="{{ url('components/user_logout') }}" onclick="return confirm('Bạn có chắc chắn muốn đăng xuất?');" class="delete-btn">Đăng xuất</a>
            </div>
            <p class="account">
               <a href="{{ url('register') }}">Đăng ký mới</a>
            </p>
         @else
            <b><p class="name">VUI LÒNG ĐĂNG NHẬP<br>!!!</p></b>
            <a href="{{ url('login') }}" class="btn">Đăng nhập</a>
            <p class="account">
               <a href="{{ url('register') }}">Đăng ký mới</a>
            </p>
         @endif
      </div>

   </section>
</header>
