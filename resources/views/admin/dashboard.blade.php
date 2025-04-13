@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<h1 class="mb-4">Dashboard</h1>

<div class="row">
    <!-- User Count Card -->
    <div class="col-md-3 mb-4">
        <div class="card bg-primary text-white h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase">Người dùng</h6>
                        <h2>{{ $userCount ?? 0 }}</h2>
                    </div>
                    <i class="fas fa-users fa-2x"></i>
                </div>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a href="{{ url('/admin/user') }}" class="text-white">Xem chi tiết</a>
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
                        <h2>{{ $productCount ?? 0 }}</h2>
                    </div>
                    <i class="fas fa-box fa-2x"></i>
                </div>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a href="{{ url('/admin/products') }}" class="text-white">Xem chi tiết</a>
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
                        <h2>{{ $orderCount ?? 0 }}</h2>
                    </div>
                    <i class="fas fa-shopping-cart fa-2x"></i>
                </div>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a href="{{ url('/admin/orders') }}" class="text-white">Xem chi tiết</a>
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
                        <h2>{{ number_format($totalRevenue ?? 0, 0, ',', '.') }} đ</h2>
                    </div>
                    <i class="fas fa-dollar-sign fa-2x"></i>
                </div>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a href="{{ url('/admin/statistical') }}" class="text-white">Xem chi tiết</a>
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
@endsection 