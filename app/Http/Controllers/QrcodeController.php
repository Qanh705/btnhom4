<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class QrcodeController extends Controller
{
    public function showQRCode()
    {
        if (!Session::has('user_id')) {
            return redirect('/');
        }

        return view('qrcode');
    }

   public function confirmPayment(Request $request)
{
    $user_id = Session::get('user_id');
    $code = $request->input('payment_code');
    $valid_code = '123456'; // Tạm hardcode

    if ($code !== $valid_code) {
        return back()->with('error', 'Mã xác nhận không đúng!');
    }

    $cartItems = DB::table('cart')->where('user_id', $user_id)->get();

    if ($cartItems->isEmpty()) {
        return redirect('/orders')->with('message', 'empty_cart');
    }

    // Tính toán tổng giá và sản phẩm
    $total_price = 0;
    $total_products = '';
    foreach ($cartItems as $item) {
        $total_price += $item->price * $item->quantity;
        $total_products .= $item->name . ' (' . $item->quantity . ') ';
    }

    // Lấy thông tin user
    $user = DB::table('users')->where('id', $user_id)->first();

    // Insert đơn hàng
    $order_id = DB::table('orders')->insertGetId([
        'user_id'        => $user_id,
        'name'           => $user->name,
        'number'         => $user->number,
        'email'          => $user->email,
        'address'        => $user->address,
        'total_products' => $total_products,
        'total_price'    => $total_price,
        'method'         => 'paytm', // gán trực tiếp
        'payment_status' => 'Đang xử lí',
    ]);

    // Xóa giỏ hàng
    DB::table('cart')->where('user_id', $user_id)->delete();

    // Điều hướng đến chi tiết đơn hàng
    return redirect('/orders/detail?id=' . $order_id)->with('message', 'success');
}


}