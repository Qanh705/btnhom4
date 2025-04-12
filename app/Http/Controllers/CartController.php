<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::where('user_id', Auth::id())->get();
        return view('cart.index', compact('carts'));
    }

    public function store(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        $cart = Cart::where('user_id', Auth::id())
            ->where('pid', $id)
            ->first();

        if ($cart) {
            $cart->quantity += $request->quantity;
            $cart->save();
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'pid' => $id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $request->quantity,
                'image' => $product->image
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function update(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);
        $cart->quantity = $request->quantity;
        $cart->save();
        return redirect()->back()->with('success', 'Cart updated successfully!');
    }

    public function destroy($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();
        return redirect()->back()->with('success', 'Product removed from cart successfully!');
    }
}
