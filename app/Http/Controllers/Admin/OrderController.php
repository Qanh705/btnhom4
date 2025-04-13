<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Schema;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        // Kiểm tra bảng orders có tồn tại không
        if (!Schema::hasTable('orders')) {
            return view('admin.orders.index', [
                'orders' => [], 
                'stats' => [
                    'pending_count' => 0,
                    'pending_total' => 0,
                    'completed_count' => 0,
                    'completed_total' => 0,
                    'cancelled_count' => 0,
                    'cancelled_total' => 0,
                    'total_count' => 0,
                    'total_revenue' => 0
                ],
                'status' => 'all',
                'error' => 'Bảng đơn hàng chưa được tạo. Vui lòng chạy lệnh "php artisan migrate" để tạo bảng.'
            ]);
        }
        
        $status = $request->get('status', 'all');
        
        $ordersQuery = Order::orderBy('id', 'desc');
        
        if ($status !== 'all') {
            $ordersQuery->where('payment_status', $status);
        }
        
        $orders = $ordersQuery->get();

        $pendingOrders = Order::where('payment_status', 'Đang xử lí')->get();
        $completedOrders = Order::where('payment_status', 'Hoàn thành')->get();
        $cancelledOrders = Order::where('payment_status', 'Đã hủy')->get();

        $stats = [
            'pending_count' => $pendingOrders->count(),
            'pending_total' => $pendingOrders->sum('total_price'),
            'completed_count' => $completedOrders->count(),
            'completed_total' => $completedOrders->sum('total_price'),
            'cancelled_count' => $cancelledOrders->count(),
            'cancelled_total' => $cancelledOrders->sum('total_price'),
            'total_count' => $pendingOrders->count() + $completedOrders->count() + $cancelledOrders->count(),
            'total_revenue' => $pendingOrders->sum('total_price') + $completedOrders->sum('total_price')
        ];

        return view('admin.orders.index', compact('orders', 'stats', 'status'));
    }

    public function updateStatus(Request $request)
    {
        // Kiểm tra bảng orders có tồn tại không
        if (!Schema::hasTable('orders')) {
            return response()->json([
                'success' => false,
                'message' => 'Bảng đơn hàng chưa được tạo. Vui lòng chạy lệnh "php artisan migrate" để tạo bảng.'
            ], 500);
        }
        
        try {
            $order = Order::findOrFail($request->order_id);
            $oldStatus = $order->payment_status;
            $order->payment_status = $request->payment_status;
            $order->save();

            // Get updated statistics
            $pendingOrders = Order::where('payment_status', 'Đang xử lí')->get();
            $completedOrders = Order::where('payment_status', 'Hoàn thành')->get();
            $cancelledOrders = Order::where('payment_status', 'Đã hủy')->get();

            $stats = [
                'pending_count' => $pendingOrders->count(),
                'pending_total' => $pendingOrders->sum('total_price'),
                'completed_count' => $completedOrders->count(),
                'completed_total' => $completedOrders->sum('total_price'),
                'cancelled_count' => $cancelledOrders->count(),
                'cancelled_total' => $cancelledOrders->sum('total_price'),
                'total_count' => $pendingOrders->count() + $completedOrders->count() + $cancelledOrders->count(),
                'total_revenue' => $pendingOrders->sum('total_price') + $completedOrders->sum('total_price')
            ];

            return response()->json([
                'success' => true,
                'message' => 'Cập nhật trạng thái đơn hàng thành công!',
                'order' => $order,
                'stats' => $stats,
                'oldStatus' => $oldStatus
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi cập nhật trạng thái: ' . $e->getMessage()
            ], 500);
        }
    }

    public function delete($id)
    {
        // Kiểm tra bảng orders có tồn tại không
        if (!Schema::hasTable('orders')) {
            return redirect()->route('admin.orders.index')
                ->with('error', 'Bảng đơn hàng chưa được tạo. Vui lòng chạy lệnh "php artisan migrate" để tạo bảng.');
        }
        
        $order = Order::findOrFail($id);
        $order->delete();
        
        return redirect()->route('admin.orders.index')
            ->with('success', 'Đã xóa đơn hàng thành công!');
    }
} 