<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
        :root {
            --sidebar-bg: #343a40;
            --sidebar-hover: #23272b;
        }
        
        .admin-products {
            padding: 12px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .header-section {
            background: white;
            padding: 12px 16px;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            margin-bottom: 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .page-title {
            font-size: 1.1rem;
            color: #2c3e50;
            margin: 0;
            font-weight: 500;
        }

        .add-new-btn {
            background: var(--sidebar-bg);
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .add-new-btn:hover {
            background: var(--sidebar-hover);
            transform: translateY(-1px);
        }

        .add-product-form {
            background: white;
            padding: 16px;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            margin-bottom: 16px;
        }

        .form-group {
            margin-bottom: 12px;
        }

        .form-group label {
            display: block;
            margin-bottom: 4px;
            color: #4a5568;
            font-weight: 500;
            font-size: 0.85rem;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 6px 10px;
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            font-size: 0.85rem;
            transition: all 0.2s;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: var(--sidebar-bg);
            box-shadow: 0 0 0 2px rgba(52, 58, 64, 0.05);
            outline: none;
        }

        .product-form button {
            background: var(--sidebar-bg);
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.2s;
            font-size: 0.85rem;
        }

        .product-form button:hover {
            background: var(--sidebar-hover);
            transform: translateY(-1px);
        }

        .product-table {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }

        .product-table table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.85rem;
        }

        .product-table th {
            background: var(--sidebar-bg);
            color: white;
            padding: 8px 10px;
            text-align: left;
            font-weight: 500;
            font-size: 0.85rem;
        }

        .product-table td {
            padding: 6px 10px;
            border-bottom: 1px solid #f0f0f0;
            vertical-align: middle;
            color: #4a5568;
        }

        .product-table tr:last-child td {
            border-bottom: none;
        }

        .product-table tr:hover {
            background: #f8fafc;
        }

        .product-table img {
            width: 40px;
            height: 40px;
            object-fit: cover;
            border-radius: 4px;
        }

        .edit-input,
        .edit-select {
            width: 100%;
            padding: 4px 8px;
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            font-size: 0.85rem;
            transition: all 0.2s;
            background: white;
        }

        .edit-input:focus,
        .edit-select:focus {
            border-color: var(--sidebar-bg);
            box-shadow: 0 0 0 2px rgba(52, 58, 64, 0.05);
            outline: none;
        }

        .edit-input[type="number"] {
            width: 100px;
        }

        .action-buttons {
            display: flex;
            gap: 4px;
        }

        .action-buttons a {
            padding: 4px 8px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.2s;
            font-size: 0.8rem;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            text-decoration: none;
        }

        .edit-btn {
            background: #3b82f6;
            color: white;
        }

        .delete-btn {
            background: #ef4444;
            color: white;
        }

        .action-buttons a:hover {
            transform: translateY(-1px);
            filter: brightness(1.1);
        }

        .action-buttons i {
            font-size: 0.8rem;
        }

        .empty-message {
            text-align: center;
            padding: 20px;
            color: #64748b;
            font-size: 0.9rem;
        }

        .table-actions {
            padding: 12px;
            background: #f8fafc;
            border-top: 1px solid #e2e8f0;
            display: flex;
            justify-content: flex-end;
        }

        .save-all-btn {
            background: var(--sidebar-bg);
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.2s;
        }

        .save-all-btn:hover {
            background: var(--sidebar-hover);
            transform: translateY(-1px);
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
                        <a class="nav-link text-white active" href="{{ route('admin.products.index') }}">
                            <i class="fas fa-box mr-2"></i> Quản lý sản phẩm
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('admin.orders.index') }}">
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
                <div class="admin-products">
                    <div class="header-section">
                        <h1 class="page-title">Quản lý sản phẩm</h1>
                        <button type="button" class="add-new-btn" onclick="showAddForm()">
                            <i class="fas fa-plus"></i> Thêm sản phẩm mới
                        </button>
                    </div>

                    @if(session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif

                    @if(session('error') || isset($error))
                        <div class="alert alert-danger">
                            {{ session('error') ?? $error }}
                        </div>
                    @endif

                    <div class="add-product-form" id="addProductForm" style="display: none;">
                        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="product-form">
                            @csrf
                            <div class="form-group">
                                <label>Tên sản phẩm:</label>
                                <input type="text" name="name" required maxlength="100">
                            </div>
                            <div class="form-group">
                                <label>Danh mục:</label>
                                <select name="category" required>
                                    <option value="">-- Chọn danh mục --</option>
                                    <option value="điện thoại">Điện thoại</option>
                                    <option value="máy tính">Máy tính</option>
                                    <option value="phụ kiện">Phụ kiện</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Giá (VNĐ):</label>
                                <input type="number" name="price" required min="0">
                            </div>
                            <div class="form-group">
                                <label>Hình ảnh:</label>
                                <input type="file" name="image" required accept="image/*">
                            </div>
                            <button type="submit">Thêm sản phẩm</button>
                        </form>
                    </div>

                    <div class="product-table">
                        <form action="{{ route('admin.products.update') }}" method="POST" id="updateForm">
                            @csrf
                            <table>
                                <thead>
                                    <tr>
                                        <th style="width: 60px;">ID</th>
                                        <th style="width: 80px;">Hình ảnh</th>
                                        <th>Tên sản phẩm</th>
                                        <th style="width: 120px;">Danh mục</th>
                                        <th style="width: 150px;">Giá (VNĐ)</th>
                                        <th style="width: 120px;">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($products) > 0)
                                        @foreach($products as $product)
                                        <tr>
                                            <td>{{ $product->id }}</td>
                                            <td>
                                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                                            </td>
                                            <td>
                                                <input type="text" name="name[{{ $product->id }}]" value="{{ $product->name }}" class="edit-input" required>
                                            </td>
                                            <td>
                                                <select name="category[{{ $product->id }}]" class="edit-select" required>
                                                    <option value="điện thoại" {{ $product->category == 'điện thoại' ? 'selected' : '' }}>Điện thoại</option>
                                                    <option value="máy tính" {{ $product->category == 'máy tính' ? 'selected' : '' }}>Máy tính</option>
                                                    <option value="phụ kiện" {{ $product->category == 'phụ kiện' ? 'selected' : '' }}>Phụ kiện</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" name="price[{{ $product->id }}]" value="{{ $product->price }}" class="edit-input" min="0" required>
                                            </td>
                                            <td>
                                                <div class="action-buttons">
                                                    <a href="{{ route('admin.products.delete', $product->id) }}" class="delete-btn" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">
                                                        <i class="fas fa-trash"></i> Xóa
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="6" class="empty-message">Không có sản phẩm nào.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                            
                            @if(count($products) > 0)
                            <div class="table-actions">
                                <button type="submit" class="save-all-btn">
                                    <i class="fas fa-save"></i> Lưu tất cả thay đổi
                                </button>
                            </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <script>
        function showAddForm() {
            const form = document.getElementById('addProductForm');
            if (form.style.display === 'none') {
                form.style.display = 'block';
            } else {
                form.style.display = 'none';
            }
        }
    </script>
</body>
</html> 