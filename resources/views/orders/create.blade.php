@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1>Checkout</h1>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <form action="{{ route('orders.store') }}" method="POST">
            @csrf
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Shipping Information</h5>
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ auth()->user()->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="number" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="number" name="number" value="{{ auth()->user()->number }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" id="address" name="address" rows="3" required>{{ auth()->user()->address }}</textarea>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Payment Method</h5>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="method" id="cash" value="cash on delivery" checked>
                        <label class="form-check-label" for="cash">
                            Cash on Delivery
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="method" id="credit" value="credit card">
                        <label class="form-check-label" for="credit">
                            Credit Card
                        </label>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Place Order</button>
        </form>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Order Summary</h5>
                <table class="table">
                    <tbody>
                        @foreach($carts as $cart)
                            <tr>
                                <td>{{ $cart->name }} x {{ $cart->quantity }}</td>
                                <td class="text-end">{{ number_format($cart->price * $cart->quantity) }} VND</td>
                            </tr>
                        @endforeach
                        <tr>
                            <th>Total</th>
                            <th class="text-end">{{ number_format($carts->sum(function($cart) { return $cart->price * $cart->quantity; })) }} VND</th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection 