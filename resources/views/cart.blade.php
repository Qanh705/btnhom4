@extends('layouts.app')

@section('content')
<div class="heading">
    <h3>Giỏ hàng của bạn</h3>
    <p><a href="{{ route('home') }}">Trở về trang chủ</a></p>
</div>

<section class="products">
    <div class="box-container">
        @forelse($cart_items as $item)
            <form action="{{ route('cart.updateQty') }}" method="POST" class="box">
                @csrf
                <input type="hidden" name="cart_id" value="{{ $item->id }}">
                <a href="{{ url('quick_view/' . $item->pid) }}" class="fas fa-eye"></a>
                <button type="submit" class="fas fa-times" formaction="{{ route('cart.delete') }}" name="delete" onclick="return confirm('xóa sản phẩm này?');"></button>
                <img src="{{ asset($item->image) }}" alt="">
                <div class="name">{{ $item->name }}</div>
                <div class="flex">
                    <div class="price">{{ number_format($item->price, 0, ',', '.') }}<span>.VNĐ</span></div>
                    <input type="number" name="qty" class="qty" min="1" max="99" value="{{ $item->quantity }}">
                    <button type="submit" class="fas fa-edit" name="update_qty"></button>
                </div>
                <div class="sub-total">
                    Tổng : {{ number_format($item->price * $item->quantity, 0, ',', '.') }}<span>.VNĐ</span>
                </div>
            </form>
        @empty
            <p class="empty">không có sản phẩm nào</p>
        @endforelse
    </div>

    <div class="cart-total">
        <p class="grand-total">Tổng tiền : {{ number_format($grand_total, 0, ',', '.') }}<span>.VNĐ</span></p>
        <b><a href="{{ url('checkout') }}" class="btn {{ $grand_total > 0 ? '' : 'disabled' }}">Thanh toán</a></b>
    </div>

    <div class="more-btn">
        <form action="{{ route('cart.deleteAll') }}" method="POST">
            @csrf
            <button type="submit" class="delete-btn {{ $grand_total > 0 ? '' : 'disabled' }}" onclick="return confirm('xóa tất cả sản phẩm?');">Xóa tất cả</button>
        </form>
        <b><a href="{{ url('menu') }}" class="btn">Tiếp tục mua sắm</a></b>
    </div>
</section>
@endsection