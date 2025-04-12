<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->get();
        return view('orders.index', compact('orders'));
    }

    public function store(Request $request)
    {
        $carts = Cart::where('user_id', Auth::id())->get();
        
        $total_products = '';
        $total_price = 0;
        
        foreach ($carts as $cart) {
            $total_products .= $cart->name . ' (' . $cart->price . ' x ' . $cart->quantity . ') - ';
            $total_price += $cart->price * $cart->quantity;
        }

        Order::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'number' => $request->number,
            'email' => $request->email,
            'method' => $request->method,
            'address' => $request->address,
            'total_products' => $total_products,
            'total_price' => $total_price,
            'payment_status' => 'pending'
        ]);

        Cart::where('user_id', Auth::id())->delete();

        return redirect()->route('orders.index')->with('success', 'Order placed successfully!');
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);
        return view('orders.show', compact('order'));
    }
}
