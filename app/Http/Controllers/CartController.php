<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;

class CartController extends Controller
{
    public function index() {
        $user_id = Auth::id();
        $cart_items = Cart::where('user_id', $user_id)->get();
        $grand_total = $cart_items->sum(fn($item) => $item->price * $item->quantity);
        return view('cart.index', compact('cart_items', 'grand_total'));
    }

    public function updateQty(Request $request) {
        $request->validate([
            'cart_id' => 'required|exists:carts,id',
            'qty' => 'required|integer|min:1|max:99',
        ]);

        $cart = Cart::find($request->cart_id);
        $cart->quantity = $request->qty;
        $cart->save();

        return back()->with('message', 'Đã cập nhật số lượng thành công.');
    }

    public function delete(Request $request) {
        Cart::where('id', $request->cart_id)->delete();
        return back()->with('message', 'Xóa sản phẩm thành công.');
    }

    public function deleteAll() {
        $user_id = Auth::id();
        Cart::where('user_id', $user_id)->delete();
        return back()->with('message', 'Xóa tất cả sản phẩm.');
    }
}
