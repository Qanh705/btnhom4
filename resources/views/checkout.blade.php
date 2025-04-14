<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Thanh toán</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

@include ('components.user_header')

<div class="heading">
   <h3>Thanh toán</h3>
   <p><a href="{{ url('/') }}">Trở về trang chủ</a></p>
</div>

<section class="checkout">
   <h1 class="title">đơn hàng của bạn</h1>

   <form action="{{ url('/checkout') }}" method="post">
      @csrf

      <div class="cart-items">
         <h3>Đơn hàng</h3>

         @php
            $total_products = '';
            $grand_total = 0;
         @endphp

         @if($cart->count())
            @foreach($cart as $item)
               @php
                  $grand_total += $item->price * $item->quantity;
               @endphp
               <p>
                  <span class="name">{{ $item->name }}</span>
                  <span class="price">{{ number_format($item->price, 0, ',', '.') }} x {{ $item->quantity }}.VNĐ</span>
               </p>
            @endforeach
         @else
            <p class="empty">Giỏ hàng của bạn đang trống</p>
         @endif

         <p class="grand-total"><span class="name">Tổng :</span><span class="price">{{ number_format($grand_total, 0, ',', '.') }}.VNĐ</span></p>
         <b><a href="{{ url('/cart') }}" class="btn">Xem lại giỏ hàng</a></b>
      </div>

      <input type="hidden" name="total_products" value="{{ $cart->map(fn($item) => $item->name . ' (' . $item->price . ' x ' . $item->quantity . ')')->implode(' - ') }}">
      <input type="hidden" name="total_price" value="{{ $grand_total }}">

      <input type="hidden" name="name" value="{{ $profile->name }}">
      <input type="hidden" name="number" value="{{ $profile->number }}">
      <input type="hidden" name="email" value="{{ $profile->email }}">
      <input type="hidden" name="address" value="{{ $profile->address }}">

      <div class="user-info">
         <h3>thông tin của bạn</h3>
         <p><i class="fas fa-user"></i><span>{{ $profile->name }}</span></p>
         <p><i class="fas fa-phone"></i><span>{{ $profile->number }}</span></p>
         <p><i class="fas fa-envelope"></i><span>{{ $profile->email }}</span></p>
         <b><a href="{{ url('/update_profile') }}" class="btn">Cập nhật thông tin</a></b>

         <h3>địa chỉ giao hàng</h3>
         <p><i class="fas fa-map-marker-alt"></i><span>{{ $profile->address ?: 'Vui lòng nhập địa chỉ' }}</span></p>
         <b><a href="{{ url('/update_address') }}" class="btn">Cập nhật địa chỉ</a></b>

         <select name="method" class="box" required>
            <option value="" disabled selected>Chọn phương thức thanh toán --</option>
            <option value="cash on delivery">Tiền mặt</option>
            <option value="paytm">Thanh toán qua ngân hàng</option>
         </select>

         <input type="submit" value="đặt hàng" class="btn {{ $profile->address == '' ? 'disabled' : '' }}" style="width:100%; background:var(--red); color:var(--white);" name="submit">
      </div>
   </form>
</section>

@include('components.footer')
<script src="{{ asset('js/script.js') }}"></script>

</body>
</html>