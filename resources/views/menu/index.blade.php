@include('components.user_header')

<div class="heading">
   <h3>Tất cả sản phẩm</h3>
   <p><a href="{{ url('/') }}">Trở về trang chủ</a></p>
</div>

<section class="products">
   <div class="box-container">
      @if($products->count() > 0)
         @foreach($products as $product)
            <form action="{{ url('/menu/buy-now') }}" method="post" class="box">
               @csrf
               <input type="hidden" name="pid" value="{{ $product->id }}">
               <input type="hidden" name="name" value="{{ $product->name }}">
               <input type="hidden" name="price" value="{{ $product->price }}">
               <input type="hidden" name="image" value="{{ $product->image }}">
               
               <button type="submit" class="fas fa-shopping-cart" name="add_to_cart"></button>
               <a href="{{ url('quick_view/' . $product->id) }}" class="image">
                  <img src="{{ $product->image }}" alt="{{ $product->name }}">
                  <!-- <img src="{{ asset('hinhanh/' . $product->image) }}" alt="{{ $product->name }}"> -->

               </a>
               <div class="name">{{ $product->name }}</div>
               <div class="flex">
                  <div class="price">{{ number_format($product->price, 0, ',', '.') }}<span>.VNĐ</span></div>
                  <input type="number" name="qty" class="qty" min="1" max="99" value="1">
               </div>
               <button type="submit" name="buy_now" class="buy-now-btn">Mua ngay</button>
            </form>
         @endforeach
      @else
         <p class="empty">Không có sản phẩm nào được cập nhật</p>
      @endif
   </div>
</section>

@include('components.footer')
