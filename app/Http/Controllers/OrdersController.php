<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    public function showUserOrders(Request $request)
    {
        if (!session()->has('user_id')) {
            return redirect('/');
        }

        $user_id = session('user_id');

        // Phân trang
        $ordersPerPage = 10;
        $currentPage = max(1, (int)$request->get('page', 1));
        $offset = ($currentPage - 1) * $ordersPerPage;

        // Tổng số đơn hàng
        $totalOrders = DB::table('orders')->where('user_id', $user_id)->count();
        $totalPages = ceil($totalOrders / $ordersPerPage);

        // Lấy danh sách đơn hàng
        $orders = DB::table('orders')
            ->where('user_id', $user_id)
            ->offset($offset)
            ->limit($ordersPerPage)
            ->get();

        return view('orders', compact('orders', 'totalPages', 'currentPage', 'offset'));
    }
    public function detail(Request $request)
{
    if (!session()->has('user_id')) {
        return redirect('/');
    }

    $user_id = session('user_id');
    $order_id = $request->query('id');  // Lấy id từ query parameter

    if (!$order_id) {
        return response("Không tìm thấy đơn hàng.", 404);
    }

    $order = DB::table('orders')
        ->where('id', $order_id)
        ->where('user_id', $user_id)
        ->first();

    if (!$order) {
        return response("<p>Không tìm thấy thông tin đơn hàng!</p>", 404);
    }

    return view('orders_detail', compact('order'));
}
}

