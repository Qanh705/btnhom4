<x-user_header />

<h1 class="title">Chi tiết sản phẩm</h1>

<section class="quick-view">
   <form action="" method="post" class="product-box">
      @csrf
      <input type="hidden" name="pid" value="{{ $product->id }}">
      <input type="hidden" name="name" value="{{ $product->name }}">
      <input type="hidden" name="price" value="{{ $product->price }}">
      <input type="hidden" name="image" value="{{ $product->image }}">

      <div class="product-detail-grid">
         <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="product-img">

         <div class="product-info">
            <h2 class="product-name">{{ $product->name }}</h2>
            <div class="product-price">{{ number_format($product->price, 0, ',', '.') }} <span>VNĐ</span></div>

            <div class="quantity-cart">
               <label for="qty">Số lượng:</label>
               <input type="number" name="qty" class="qty" min="1" max="99" value="1">
               <button type="submit" class="btn-cart">Thêm Vào Giỏ Hàng</button>
            </div>

            <div class="product-description">
               <h3>Mô tả chi tiết sản phẩm</h3>
               <p class="des">{{ $product->des }}</p>
            </div>
         </div>
      </div>
   </form>
</section>

<x-footer />
