@extends('layouts.app')

@section('title', 'Order Details')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1>Order Details #{{ $order->id }}</h1>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Order Information</h5>
                <p><strong>Order Date:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
                <p><strong>Payment Status:</strong> 
                    <span class="badge bg-{{ $order->payment_status === 'pending' ? 'warning' : 'success' }}">
                        {{ $order->payment_status }}
                    </span>
                </p>
                <p><strong>Payment Method:</strong> {{ $order->method }}</p>
                <p><strong>Total Price:</strong> {{ number_format($order->total_price) }} VND</p>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Shipping Information</h5>
                <p><strong>Name:</strong> {{ $order->name }}</p>
                <p><strong>Email:</strong> {{ $order->email }}</p>
                <p><strong>Phone:</strong> {{ $order->number }}</p>
                <p><strong>Address:</strong> {{ $order->address }}</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Ordered Products</h5>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(explode(' - ', $order->total_products) as $product)
                                @if($product)
                                    @php
                                        $parts = explode('(', $product);
                                        $name = trim($parts[0]);
                                        $details = explode('x', trim($parts[1], ')'));
                                        $price = trim($details[0]);
                                        $quantity = trim($details[1]);
                                    @endphp
                                    <tr>
                                        <td>{{ $name }}</td>
                                        <td>{{ $quantity }}</td>
                                        <td>{{ number_format($price) }} VND</td>
                                        <td>{{ number_format($price * $quantity) }} VND</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 