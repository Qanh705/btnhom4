<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        $user_id = Session::get('user_id');
        if (!$user_id) {
            return redirect('/');
        }

        $message = [];
        $total_products = '';
        $grand_total = 0;

        $profile = DB::table('users')->where('id', $user_id)->first();
        $cart = DB::table('cart')->where('user_id', $user_id)->get();

        if ($request->isMethod('post')) {
            $method = $request->input('method');

            if ($method == 'paytm') {
                return redirect('qrcode');
            }

            if ($cart->count() > 0) {
                if (empty($profile->address)) {
                    $message[] = 'Vui lòng cung cấp thông tin địa chỉ!';
                } else {
                    $total_products_arr = [];
                    foreach ($cart as $item) {
                        $total_products_arr[] = $item->name . ' (' . $item->price . ' x ' . $item->quantity . ') - ';
                        $grand_total += $item->price * $item->quantity;
                    }
                    $total_products = implode($total_products_arr);

                    DB::table('orders')->insert([
                        'user_id'        => $user_id,
                        'name'           => $profile->name,
                        'number'         => $profile->number,
                        'email'          => $profile->email,
                        'method'         => $method,
                        'address'        => $profile->address,
                        'total_products' => $total_products,
                        'total_price'    => $grand_total,
                        'payment_status' => 'Đang xử lí',
                    ]);

                    DB::table('cart')->where('user_id', $user_id)->delete();

                    return redirect('orders?message=success');
                }
            } else {
                $message[] = 'Giỏ hàng đang trống';
            }
        }

        return view('checkout', [
            'profile'       => $profile,
            'cart'          => $cart,
            'grand_total'   => $grand_total,
            'message'       => $message,
        ]);
    }
}