@extends('layouts.app')

@section('title', 'My Orders')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1>My Orders</h1>
    </div>
</div>

@if($orders->isEmpty())
    <div class="alert alert-info">
        You haven't placed any orders yet. <a href="{{ route('home') }}">Start shopping</a>
    </div>
@else
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Date</th>
                    <th>Total Products</th>
                    <th>Total Price</th>
                    <th>Payment Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>#{{ $order->id }}</td>
                        <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                        <td>{{ $order->total_products }}</td>
                        <td>{{ number_format($order->total_price) }} VND</td>
                        <td>
                            <span class="badge bg-{{ $order->payment_status === 'pending' ? 'warning' : 'success' }}">
                                {{ $order->payment_status }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-primary btn-sm">View Details</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
@endsection 