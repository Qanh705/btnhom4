<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\Message;
use DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Kiểm tra đăng nhập
        if (!Session::has('admin_id')) {
            return redirect('admin/login');
        }
        
        // Lấy thông tin tổng quan
        $userCount = User::count();
        $productCount = Product::count();
        $orderCount = Order::count();
        $messageCount = Message::count();
        
        // Doanh thu
        $totalRevenue = Order::sum('total_price');
        
        return view('admin.dashboard', compact('userCount', 'productCount', 'orderCount', 'messageCount', 'totalRevenue'));
    }

    public function manageUsers()
    {
        // Lấy danh sách người dùng
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function statistics()
    {
        // Lấy thống kê theo tháng
        $monthlySales = Order::select(DB::raw('MONTH(created_at) as month'), DB::raw('SUM(total_price) as total_sales'))
            ->groupBy('month')
            ->get();
            
        // Lấy 5 sản phẩm mới nhất theo ID
        $topProducts = Product::orderBy('id', 'desc')
            ->take(5)
            ->get();
            
        return view('admin.statistics', compact('monthlySales', 'topProducts'));
    }

    public function receiveMessages()
    {
        // Lấy danh sách tin nhắn
        $messages = Message::with('user')->orderBy('id', 'desc')->get();
        return view('admin.messages', compact('messages'));
    }
}
