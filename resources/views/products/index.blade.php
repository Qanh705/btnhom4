@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="row">
    <div class="col-md-12 mb-4">
        <h1>Welcome to Phone Store</h1>
        <p>Discover the latest smartphones at the best prices</p>
    </div>
</div>

<div class="row">
    @foreach($products as $product)
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="{{ asset('images/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">{{ number_format($product->price) }} VND</p>
                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary">View Details</a>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection 