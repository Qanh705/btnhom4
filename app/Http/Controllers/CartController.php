<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function show(Request $request)
    {
        $user_id = Session::get('user_id');
        if (!$user_id) {
            return redirect('/');
        }

        $message = [];

        //Thêm sản phẩm vào giỏ hàng
        if ($request->isMethod('post') && $request->has('add_to_cart')) {
            $pid = $request->input('pid');
            $name = $request->input('name');
            $price = $request->input('price');
            $image = $request->input('image');
            $qty = $request->input('qty');

            $existing = DB::table('cart')->where([
                ['user_id', '=', $user_id],
                ['pid', '=', $pid]
            ])->first();

            if ($existing) {
                // tăng sản phẩm khi nó đã có trong giỏ 
                $newQty = $existing->quantity + $qty;
                DB::table('cart')->where('id', $existing->id)->update(['quantity' => $newQty]);
            } else {

                DB::table('cart')->insert([
                    'user_id' => $user_id,
                    'pid' => $pid,
                    'name' => $name,
                    'price' => $price,
                    'image' => $image,
                    'quantity' => $qty
                ]);
            }

            $message[] = 'Đã thêm vào giỏ hàng!';
        }

        if ($request->isMethod('post') && $request->has('delete')) {
            $cart_id = $request->input('cart_id');
            DB::table('cart')->where('id', $cart_id)->delete();
            $message[] = 'Xóa sản phẩm thành công.';
        }

        if ($request->isMethod('post') && $request->has('delete_all')) {
            DB::table('cart')->where('user_id', $user_id)->delete();
            $message[] = 'Xóa tất cả sản phẩm';
        }

        if ($request->isMethod('post') && $request->has('update_qty')) {
            $cart_id = $request->input('cart_id');
            $qty = htmlspecialchars($request->input('qty'), ENT_QUOTES, 'UTF-8');
            DB::table('cart')->where('id', $cart_id)->update(['quantity' => $qty]);
            $message[] = 'Đã cập nhật số lượng thành công.';
        }

        $cart_items = DB::table('cart')->where('user_id', $user_id)->get();
        $grand_total = 0;

        foreach ($cart_items as $item) {
            $grand_total += $item->price * $item->quantity;
        }

        return view('cart', compact('user_id', 'cart_items', 'grand_total', 'message'));
    }
}
