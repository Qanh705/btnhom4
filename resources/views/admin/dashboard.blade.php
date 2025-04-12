<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 bg-dark text-white py-4" style="min-height: 100vh;">
                <h4 class="text-center">ADMIN</h4>
                <ul class="nav flex-column mt-4">
                    <li class="nav-item">
                        <a class="nav-link text-white active" href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('admin.users') }}">
                            <i class="fas fa-users mr-2"></i> Quản lý người dùng
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
                <h1 class="mb-4">Dashboard</h1>
                
                <div class="row">
                    <!-- User Count Card -->
                    <div class="col-md-3 mb-4">
                        <div class="card bg-primary text-white h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-uppercase">Người dùng</h6>
                                        <h2>{{ $userCount }}</h2>
                                    </div>
                                    <i class="fas fa-users fa-2x"></i>
                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a href="{{ route('admin.users') }}" class="text-white">Xem chi tiết</a>
                                <i class="fas fa-angle-right"></i>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Product Count Card -->
                    <div class="col-md-3 mb-4">
                        <div class="card bg-success text-white h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-uppercase">Sản phẩm</h6>
                                        <h2>{{ $productCount }}</h2>
                                    </div>
                                    <i class="fas fa-box fa-2x"></i>
                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a href="#" class="text-white">Xem chi tiết</a>
                                <i class="fas fa-angle-right"></i>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Order Count Card -->
                    <div class="col-md-3 mb-4">
                        <div class="card bg-warning text-white h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-uppercase">Đơn hàng</h6>
                                        <h2>{{ $orderCount }}</h2>
                                    </div>
                                    <i class="fas fa-shopping-cart fa-2x"></i>
                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a href="#" class="text-white">Xem chi tiết</a>
                                <i class="fas fa-angle-right"></i>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Revenue Card -->
                    <div class="col-md-3 mb-4">
                        <div class="card bg-danger text-white h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-uppercase">Doanh thu</h6>
                                        <h2>{{ number_format($totalRevenue, 0, ',', '.') }} đ</h2>
                                    </div>
                                    <i class="fas fa-dollar-sign fa-2x"></i>
                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a href="{{ route('admin.statistics') }}" class="text-white">Xem chi tiết</a>
                                <i class="fas fa-angle-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Hoạt động gần đây</h5>
                            </div>
                            <div class="card-body">
                                <p>Thông tin hoạt động mới nhất sẽ được hiển thị ở đây.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html> 