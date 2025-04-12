@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="row">
    <div class="col-md-6">
        <img src="{{ asset('images/' . $product->image) }}" class="img-fluid" alt="{{ $product->name }}">
    </div>
    <div class="col-md-6">
        <h1>{{ $product->name }}</h1>
        <p class="h3 text-primary">{{ number_format($product->price) }} VND</p>
        <p class="text-muted">Category: {{ ucfirst($product->category) }}</p>
        
        <div class="mt-4">
            <h4>Description</h4>
            <p>{{ $product->des }}</p>
        </div>

        @auth
            <form action="{{ route('cart.store', $product->id) }}" method="POST" class="mt-4">
                @csrf
                <div class="mb-3">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" value="1" min="1">
                </div>
                <button type="submit" class="btn btn-primary">Add to Cart</button>
            </form>
        @else
            <div class="alert alert-info mt-4">
                Please <a href="{{ route('login') }}">login</a> to add products to cart.
            </div>
        @endauth
    </div>
</div>
@endsection 