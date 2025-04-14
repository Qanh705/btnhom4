<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Trang chủ</title>
   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
@include('components.user_header')

<div class="heading">
   <h3>Tất cả sản phẩm</h3>
   <p><a href="{{ url('/') }}">Trở về trang chủ</a></p>
</div>

<section class="products">
   <div class="box-container">
      @if($products->count() > 0)
         @foreach($products as $product)
            <form action="{{ url('/cart') }}"  method="post" class="box">
               @csrf
               <input type="hidden" name="pid" value="{{ $product->id }}">
               <input type="hidden" name="name" value="{{ $product->name }}">
               <input type="hidden" name="price" value="{{ $product->price }}">
               <input type="hidden" name="image" value="{{ $product->image }}">
               
               <button type="submit" class="fas fa-shopping-cart" name="add_to_cart"></button>
               <a href="{{ url('quick_view/' . $product->id) }}" class="image">
                  <img src="{{ $product->image }}" alt="{{ $product->name }}">
                

               </a>
               <div class="name">{{ $product->name }}</div>
               <div class="flex">
                  <div class="price">{{ number_format($product->price, 0, ',', '.') }}<span>.VNĐ</span></div>
                  <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
               </div>
            </form>
         @endforeach
      @else
         <p class="empty">Không có sản phẩm nào được cập nhật</p>
      @endif
   </div>
</section>

@include('components.footer')


<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>


<script src="{{ asset('js/script.js') }}"></script>




<script>

var swiper = new Swiper(".hero-slider", {
   loop: true,
   grabCursor: true,
   effect: "slide", // Sử dụng hiệu ứng vuốt
   autoplay: { // Thêm tính năng tự động vuốt
      delay: 3000, // Thời gian giữa các slide (3000ms = 3 giây)
  
   },
   pagination: {
      el: ".swiper-pagination",
      clickable: true,
   },
});
</script>





</body>
</html>