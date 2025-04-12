@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1>Shopping Cart</h1>
    </div>
</div>

@if($carts->isEmpty())
    <div class="alert alert-info">
        Your cart is empty. <a href="{{ route('home') }}">Continue shopping</a>
    </div>
@else
    <div class="row">
        <div class="col-md-8">
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($carts as $cart)
                        <tr>
                            <td>
                                <img src="{{ asset('images/' . $cart->image) }}" alt="{{ $cart->name }}" width="50">
                                {{ $cart->name }}
                            </td>
                            <td>{{ number_format($cart->price) }} VND</td>
                            <td>
                                <form action="{{ route('cart.update', $cart->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="number" name="quantity" value="{{ $cart->quantity }}" min="1" class="form-control form-control-sm" style="width: 70px;">
                                </form>
                            </td>
                            <td>{{ number_format($cart->price * $cart->quantity) }} VND</td>
                            <td>
                                <form action="{{ route('cart.destroy', $cart->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Order Summary</h5>
                    <p>Total Items: {{ $carts->sum('quantity') }}</p>
                    <p>Total Price: {{ number_format($carts->sum(function($cart) { return $cart->price * $cart->quantity; })) }} VND</p>
                    <a href="{{ route('orders.create') }}" class="btn btn-primary w-100">Checkout</a>
                </div>
            </div>
        </div>
    </div>
@endif
@endsection 