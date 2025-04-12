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

<section class="hero">

   <div class="swiper hero-slider">

      <div class="swiper-wrapper">
         <div class="swiper-slide slide">
            <div class="content">
               <span>Welcome to my store</span>
               <h3>SMART TECH</h3>
               <a href="{{ url('/about') }}" class="btn">Giới thiệu</a>
            </div>
            <div class="image">
            <img src="{{ asset('hinhanh/banner.png') }}" alt="">
            </div>
         </div>

         <div class="swiper-slide slide">
            <div class="image">
            <img src="{{ asset('hinhanh/banner2.png') }}" alt="">
            </div>
         </div>
         <div class="swiper-slide slide">
            <div class="image">
            <img src="{{ asset('hinhanh/banner3.jpg') }}" alt="">
            </div>
         </div>
         
         <div class="swiper-pagination"></div>
   </div>
</section>

<section class="category">
   <h1 class="title">Danh mục điện thoại</h1>
   <div class="box-container">

      <a href="{{ url('category/iphone') }}" class="box">
         <img src="{{ asset('hinhanh/iphone.png') }}" alt="Iphone">
         <h3>Iphone</h3>
      </a>

      <a href="{{ url('category/samsung') }}" class="box">
         <img src="{{ asset('hinhanh/samsung.png') }}" alt="Samsung">
         <h3>Samsung</h3>
      </a>

      <a href="{{ url('category/oppo') }}" class="box">
         <img src="{{ asset('hinhanh/oppo.png') }}" alt="Oppo">
         <h3>Oppo</h3>
      </a>

      <a href="{{ url('category/sony') }}" class="box">
         <img src="{{ asset('hinhanh/sony.png') }}" alt="Sony">
         <h3>Sony</h3>
      </a>

   </div>
</section>



<section class="products">

   <h1 class="title">Sản phẩm gợi ý</h1>

   <div class="box-container">

   @if(count($products) > 0)
   @foreach ($products as $product)
      <form action="" method="post" class="box">
         @csrf
         <input type="hidden" name="pid" value="{{ $product->id }}">
         <input type="hidden" name="name" value="{{ $product->name }}">
         <input type="hidden" name="price" value="{{ $product->price }}">
         <input type="hidden" name="image" value="{{ $product->image }}">

         <button type="submit" class="fas fa-shopping-cart" name="add_to_cart"></button>

         <a href="{{ url('quick_view?pid=' . $product->id) }}" class="image">
         <img src="{{ url($product->image) }}" alt="{{ $product->name }}">
         </a>

         <div class="name">{{ $product->name }}</div>
         <div class="flex">
            <div class="price">{{ number_format($product->price, 0, ',', '.') }}<span>.VNĐ</span></div>
            <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
         </div>
      </form>
   @endforeach
@else
   <p class="empty">Không có sản phẩm nào được thêm</p>
@endif


   </div>

   <div class="more-btn">
      <a href="SANPHAMGOIY.php" class="btn">Xem thêm</a>
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