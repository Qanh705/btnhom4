<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistics</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                        <a class="nav-link text-white active" href="{{ route('admin.statistics') }}">
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
                <h1 class="mb-4">Thống kê</h1>
                
                <div class="row">
                    <!-- Monthly Sales Chart -->
                    <div class="col-md-8 mb-4">
                        <div class="card shadow">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Doanh thu theo tháng</h6>
                            </div>
                            <div class="card-body">
                                <canvas id="monthlySalesChart" height="300"></canvas>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Top Products -->
                    <div class="col-md-4 mb-4">
                        <div class="card shadow">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Sản phẩm bán chạy</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Sản phẩm</th>
                                                <th>Số lượng bán</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($topProducts as $product)
                                                <tr>
                                                    <td>{{ $product->name }}</td>
                                                    <td>{{ $product->orders_count }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="2" class="text-center">Không có dữ liệu</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <!-- Monthly Sales Table -->
                    <div class="col-md-12 mb-4">
                        <div class="card shadow">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Chi tiết doanh thu theo tháng</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Tháng</th>
                                                <th>Doanh thu</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($monthlySales as $sale)
                                                <tr>
                                                    <td>Tháng {{ $sale->month }}</td>
                                                    <td>{{ number_format($sale->total_sales, 0, ',', '.') }} đ</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="2" class="text-center">Không có dữ liệu</td>
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
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <script>
        // Monthly Sales Chart
        var ctx = document.getElementById('monthlySalesChart').getContext('2d');
        var monthNames = [
            'Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6',
            'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'
        ];
        
        var monthlySalesData = {
            labels: [
                @foreach($monthlySales as $sale)
                    monthNames[{{ $sale->month - 1 }}],
                @endforeach
            ],
            datasets: [{
                label: 'Doanh thu (VNĐ)',
                backgroundColor: 'rgba(78, 115, 223, 0.2)',
                borderColor: 'rgba(78, 115, 223, 1)',
                borderWidth: 1,
                data: [
                    @foreach($monthlySales as $sale)
                        {{ $sale->total_sales }},
                    @endforeach
                ]
            }]
        };
        
        var monthlySalesChart = new Chart(ctx, {
            type: 'bar',
            data: monthlySalesData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html> 