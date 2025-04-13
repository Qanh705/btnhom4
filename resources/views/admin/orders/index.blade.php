<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý đơn hàng</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
        :root {
            --sidebar-bg: #343a40;
            --sidebar-hover: #23272b;
        }
        .stats-card {
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .card-title {
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            margin-bottom: 10px;
        }
        .card-value {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .card-subtitle {
            font-size: 14px;
            color: #6c757d;
        }
        .primary-card {
            background: #cfe2ff;
            color: #0d6efd;
        }
        .success-card {
            background: #d1e7dd;
            color: #198754;
        }
        .danger-card {
            background: #f8d7da;
            color: #dc3545;
        }
        .info-card {
            background: #cff4fc;
            color: #0dcaf0;
        }
        .order-status {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        .status-pending {
            background: #cfe2ff;
            color: #0d6efd;
        }
        .status-completed {
            background: #d1e7dd;
            color: #198754;
        }
        .status-cancelled {
            background: #f8d7da;
            color: #dc3545;
        }
        .order-table th {
            font-weight: 600;
            font-size: 14px;
        }
        .order-table td {
            vertical-align: middle;
            font-size: 14px;
        }
        .action-btn {
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
            cursor: pointer;
        }
        .view-btn {
            background: #cfe2ff;
            color: #0d6efd;
        }
        .edit-btn {
            background: #d1e7dd;
            color: #198754;
        }
        .delete-btn {
            background: #f8d7da;
            color: #dc3545;
        }
        .tab-btn {
            padding: 8px 15px;
            border-radius: 6px;
            border: 1px solid #dee2e6;
            background: #fff;
            color: #495057;
            margin-right: 10px;
            font-size: 14px;
            transition: all 0.2s;
        }
        .tab-btn:hover {
            background: #f8f9fa;
        }
        .tab-btn.active {
            background: var(--sidebar-bg);
            color: white;
            border-color: var(--sidebar-bg);
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 bg-dark text-white py-4" style="min-height: 100vh;">
                <h4 class="text-center">ADMIN</h4>
                <ul class="nav flex-column mt-4">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('admin.users') }}">
                            <i class="fas fa-users mr-2"></i> Quản lý người dùng
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('admin.products.index') }}">
                            <i class="fas fa-box mr-2"></i> Quản lý sản phẩm
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white active" href="{{ route('admin.orders.index') }}">
                            <i class="fas fa-shopping-cart mr-2"></i> Quản lý đơn hàng
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('admin.statistics') }}">
                            <i class="fas fa-chart-bar mr-2"></i> Thống kê
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('admin.messages') }}">
                            <i class="fas fa-envelope mr-2"></i> Nhận thông điệp
                        </a>
                    </li>
                </ul>
            </div>
            
            <!-- Main content -->
            <div class="col-md-10 py-4">
                <h1 class="h2 mb-4">Quản lý đơn hàng</h1>
                
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error') || isset($error))
                    <div class="alert alert-danger">
                        {{ session('error') ?? $error }}
                    </div>
                @endif
                
                <!-- Thống kê -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="stats-card primary-card">
                            <div class="card-title">Đang xử lý</div>
                            <div class="card-value">{{ $stats['pending_count'] }}</div>
                            <div class="card-subtitle">{{ number_format($stats['pending_total'], 0, ',', '.') }} VNĐ</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stats-card success-card">
                            <div class="card-title">Hoàn thành</div>
                            <div class="card-value">{{ $stats['completed_count'] }}</div>
                            <div class="card-subtitle">{{ number_format($stats['completed_total'], 0, ',', '.') }} VNĐ</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stats-card danger-card">
                            <div class="card-title">Đã hủy</div>
                            <div class="card-value">{{ $stats['cancelled_count'] }}</div>
                            <div class="card-subtitle">{{ number_format($stats['cancelled_total'], 0, ',', '.') }} VNĐ</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stats-card info-card">
                            <div class="card-title">Tổng đơn hàng</div>
                            <div class="card-value">{{ $stats['total_count'] }}</div>
                            <div class="card-subtitle">{{ number_format($stats['total_revenue'], 0, ',', '.') }} VNĐ</div>
                        </div>
                    </div>
                </div>
                
                <!-- Filter tabs -->
                <div class="mb-4">
                    <a href="{{ route('admin.orders.index', ['status' => 'all']) }}" class="tab-btn {{ $status == 'all' ? 'active' : '' }}">
                        Tất cả
                    </a>
                    <a href="{{ route('admin.orders.index', ['status' => 'Đang xử lí']) }}" class="tab-btn {{ $status == 'Đang xử lí' ? 'active' : '' }}">
                        Đang xử lý
                    </a>
                    <a href="{{ route('admin.orders.index', ['status' => 'Hoàn thành']) }}" class="tab-btn {{ $status == 'Hoàn thành' ? 'active' : '' }}">
                        Hoàn thành
                    </a>
                    <a href="{{ route('admin.orders.index', ['status' => 'Đã hủy']) }}" class="tab-btn {{ $status == 'Đã hủy' ? 'active' : '' }}">
                        Đã hủy
                    </a>
                </div>
                
                <!-- Đơn hàng -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Danh sách đơn hàng</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table order-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Khách hàng</th>
                                        <th>Địa chỉ</th>
                                        <th>Sản phẩm</th>
                                        <th>Tổng tiền</th>
                                        <th>Trạng thái</th>
                                        <th>Ngày tạo</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($orders as $order)
                                    <tr data-order-id="{{ $order->id }}">
                                        <td>#{{ $order->id }}</td>
                                        <td>{{ $order->name }}<br><small>{{ $order->email }}</small></td>
                                        <td>{{ $order->address }}</td>
                                        <td>{{ $order->total_products }}</td>
                                        <td><strong>{{ number_format($order->total_price, 0, ',', '.') }} VNĐ</strong></td>
                                        <td>
                                            <span class="order-status {{ $order->payment_status == 'Đang xử lí' ? 'status-pending' : ($order->payment_status == 'Hoàn thành' ? 'status-completed' : 'status-cancelled') }}">
                                                {{ $order->payment_status }}
                                            </span>
                                        </td>
                                        <td>{{ date('d/m/Y', strtotime($order->created_at)) }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton{{ $order->id }}" data-toggle="dropdown" aria-expanded="false">
                                                    Hành động
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $order->id }}">
                                                    <a class="dropdown-item update-status" href="#" data-order-id="{{ $order->id }}" data-status="Đang xử lí">
                                                        <i class="fas fa-clock text-primary"></i> Đang xử lý
                                                    </a>
                                                    <a class="dropdown-item update-status" href="#" data-order-id="{{ $order->id }}" data-status="Hoàn thành">
                                                        <i class="fas fa-check text-success"></i> Hoàn thành
                                                    </a>
                                                    <a class="dropdown-item update-status" href="#" data-order-id="{{ $order->id }}" data-status="Đã hủy">
                                                        <i class="fas fa-times text-danger"></i> Đã hủy
                                                    </a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item" href="{{ route('admin.orders.delete', $order->id) }}" onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này?')">
                                                        <i class="fas fa-trash text-danger"></i> Xóa
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="8" class="text-center">Không có đơn hàng nào</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <script>
        $(document).ready(function() {
            // Thêm csrf token vào mọi Ajax request
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            
            $('.update-status').click(function(e) {
                e.preventDefault();
                
                const orderId = $(this).data('order-id');
                const newStatus = $(this).data('status');
                
                $.ajax({
                    url: '{{ route("admin.orders.update-status") }}',
                    type: 'POST',
                    data: {
                        order_id: orderId,
                        payment_status: newStatus
                    },
                    success: function(response) {
                        if (response.success) {
                            // Update status display
                            const row = $(`tr[data-order-id="${orderId}"]`);
                            let statusClass = '';
                            
                            if (newStatus === 'Đang xử lí') {
                                statusClass = 'status-pending';
                            } else if (newStatus === 'Hoàn thành') {
                                statusClass = 'status-completed';
                            } else {
                                statusClass = 'status-cancelled';
                            }
                            
                            row.find('.order-status').removeClass('status-pending status-completed status-cancelled')
                               .addClass(statusClass)
                               .text(newStatus);
                            
                            // Update stats
                            updateStats(response.stats);
                            
                            alert('Cập nhật trạng thái đơn hàng thành công!');
                        }
                    },
                    error: function(error) {
                        console.error('Error:', error);
                        alert('Có lỗi xảy ra khi cập nhật trạng thái đơn hàng!');
                    }
                });
            });
            
            function updateStats(stats) {
                // Update pending orders stats
                $('.primary-card .card-value').text(stats.pending_count);
                $('.primary-card .card-subtitle').text(new Intl.NumberFormat('vi-VN').format(stats.pending_total) + ' VNĐ');
                
                // Update completed orders stats
                $('.success-card .card-value').text(stats.completed_count);
                $('.success-card .card-subtitle').text(new Intl.NumberFormat('vi-VN').format(stats.completed_total) + ' VNĐ');
                
                // Update cancelled orders stats
                $('.danger-card .card-value').text(stats.cancelled_count);
                $('.danger-card .card-subtitle').text(new Intl.NumberFormat('vi-VN').format(stats.cancelled_total) + ' VNĐ');
                
                // Update total stats
                $('.info-card .card-value').text(stats.total_count);
                $('.info-card .card-subtitle').text(new Intl.NumberFormat('vi-VN').format(stats.total_revenue) + ' VNĐ');
            }
        });
    </script>
</body>
</html> 