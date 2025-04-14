<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Tìm kiếm</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

@include('components.user_header')

<section class="search-form">
   <form method="GET" action="{{ route('search') }}">
      <input type="text" name="search_box" placeholder="Tìm kiếm tại đây..." class="box" value="{{ request('search_box') }}">
      <button type="submit" class="fas fa-search"></button>
   </form>
</section>

<section class="products" style="min-height: 100vh; padding-top:0;">
   <div class="box-container">
      @if(isset($search_box) && strlen($search_box) > 0)
         @if(count($products) > 0)
            @foreach($products as $product)
               <form action="" method="post" class="box">
                  @csrf
                  <input type="hidden" name="pid" value="{{ $product->id }}">
                  <input type="hidden" name="name" value="{{ $product->name }}">
                  <input type="hidden" name="price" value="{{ $product->price }}">
                  <input type="hidden" name="image" value="{{ $product->image }}">

                  <a href="{{ url('quick_view?pid=' . $product->id) }}" class="fas fa-eye"></a>
                  <button type="submit" class="fas fa-shopping-cart" name="add_to_cart"></button>
                  <img src="{{ $product->image }}" alt="">
                  <a href="{{ url('category?category=' . $product->category) }}" class="cat">{{ $product->category }}</a>
                  <div class="name">{{ $product->name }}</div>
                  <div class="flex">
                     <div class="price">{{ $product->price }}<span>.VNĐ</span></div>
                     <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
                  </div>
               </form>
            @endforeach
         @else
            <p class="empty">Không có sản phẩm phù hợp, vui lòng chọn lại.</p>
         @endif
      @endif
   </div>
</section>


@include('components.footer')
<script src="{{ asset('js/script.js') }}"></script>

</body>
</html>
