<!DOCTYPE html>
<html lang="vi">
<head>
   <meta charset="UTF-8">
   <title>Sản phẩm gợi ý</title>
   <link rel="stylesheet" href="{{ asset('css/style.css') }}">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body>

   @php
      $user_id = session('user_id');
   @endphp

   {{-- Gọi header --}}
   @include('components.user_header', ['user_id' => $user_id])

   <div class="heading">
      <h3>Sản phẩm gợi ý</h3>
      <p><a href="{{ url('/') }}">Trở về trang chủ</a></p>
   </div>

   <section class="products">
      <div class="box-container">
         @if ($products->count() > 0)
            @foreach ($products as $product)
               <form action="" method="post" class="box">
                  @csrf
                  <input type="hidden" name="pid" value="{{ $product->id }}">
                  <input type="hidden" name="name" value="{{ $product->name }}">
                  <input type="hidden" name="price" value="{{ $product->price }}">
                  <input type="hidden" name="image" value="{{ $product->image }}">
                  <button type="submit" class="fas fa-shopping-cart" name="add_to_cart"></button>
                  <a href="#" class="image">
                  <a href="{{ url('quick_view/' . $product->id) }}">
   <img src="{{ $product->image }}" alt="{{ $product->name }}">
</a>


                     <!-- <img src="{{ asset('hinhanh/' . $product->image) }}" alt="{{ $product->name }}"> -->
                  </a>
                  <div class="name">{{ $product->name }}</div>
                  <div class="flex">
                     <div class="price">{{ number_format($product->price, 0, ',', '.') }}<span>.VNĐ</span></div>
                     <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
                  </div>
                  <button type="submit" name="buy_now" class="buy-now-btn">Mua ngay</button>
               </form>
            @endforeach
         @else
            <p class="empty">Không có sản phẩm nào được gợi ý</p>
         @endif
      </div>
   </section>

   {{-- Gọi footer --}}
   @include('components.footer')

   <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
