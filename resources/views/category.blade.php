<x-user_header />

<div class="heading">
   <h3>Danh mục: {{ ucfirst($category) }}</h3>
   <p><a href="{{ url('/') }}">Trở về trang chủ</a></p>
</div>

<section class="products">
   <h1 class="title">Sản phẩm</h1>
   <div class="box-container">
      @if ($products->count() > 0)
         @foreach ($products as $product)
            <form action="{{ url('/cart') }}" method="post" class="box">
               @csrf
               <input type="hidden" name="pid" value="{{ $product->id }}">
               <input type="hidden" name="name" value="{{ $product->name }}">
               <input type="hidden" name="price" value="{{ $product->price }}">
               <input type="hidden" name="image" value="{{ $product->image }}">

               <a href="{{ url('quick_view/' . $product->id) }}" class="image">
                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
               </a>

               <button type="submit" class="fas fa-shopping-cart" name="add_to_cart"></button>

               <div class="name">{{ $product->name }}</div>
               <div class="flex">
                  <div class="price">{{ number_format($product->price, 0, ',', '.') }}<span>.VNĐ</span></div>
                  <input type="number" name="qty" class="qty" min="1" max="99" value="1">
               </div>
            </form>
         @endforeach
      @else
         <p class="empty">Không có sản phẩm nào trong danh mục này.</p>
      @endif
   </div>
</section>

<x-footer />
