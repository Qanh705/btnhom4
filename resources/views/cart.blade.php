<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Giỏ hàng</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
@include('components.user_header')

<div class="heading">
   <h3>Giỏ hàng của bạn</h3>
   <p><a href="{{ url('/') }}">Trở về trang chủ</a></p>
</div>

<section class="products">
   @if(isset($message))
      @foreach($message as $msg)
         <div class="message">
            <span>{{ $msg }}</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
      @endforeach
   @endif

   <div class="box-container">
      @if(count($cart_items) > 0)
         @foreach($cart_items as $item)
         <form action="{{ url('/cart') }}" method="post" class="box">
            @csrf
            <input type="hidden" name="cart_id" value="{{ $item->id }}">
            <a href="{{ url('quick_view?pid=' . $item->pid) }}" class="fas fa-eye"></a>
            <button type="submit" class="fas fa-times" name="delete" onclick="return confirm('xóa sản phẩm này?');"></button>
            <img src="{{ $item->image }}" alt="">
            <div class="name">{{ $item->name }}</div>
            <div class="flex">
               <div class="price">{{ number_format($item->price, 0, ',', '.') }}<span>.VNĐ</span></div>
               <input type="number" name="qty" class="qty" min="0" max="99" value="{{ $item->quantity }}" maxlength="2">
               <button type="submit" class="fas fa-edit" name="update_qty"></button>
            </div>
            <div class="sub-total"> 
               Tổng : {{ number_format($item->price * $item->quantity, 0, ',', '.') }}<span>.VNĐ</span>
            </div>
         </form>
         @endforeach
      @else
         <p class="empty">không có sản phẩm nào</p>
      @endif
   </div>

   <div class="cart-total">
      <p class="grand-total">Tổng tiền : {{ number_format($grand_total, 0, ',', '.') }}<span>.VNĐ</span></p>
      <b><a href="{{ url('/checkout') }}" class="btn {{ $grand_total > 1 ? '' : 'disabled' }}">Thanh toán</a></b>
   </div>

   <div class="more-btn">
      <form action="{{ url('/cart') }}" method="post">
         @csrf
         <button type="submit" class="delete-btn {{ $grand_total > 1 ? '' : 'disabled' }}" name="delete_all" onclick="return confirm('xóa tất cả sản phẩm?');">Xóa tất cả</button>
      </form>
      <b><a href="{{ url('/menu') }}" class="btn">Tiếp tục mua sắm</a></b>
   </div>
</section>

@include('components.footer')
<script src="{{ asset('js/script.js') }}"></script>

</body>
</html>