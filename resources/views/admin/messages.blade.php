<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>
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
                        <a class="nav-link text-white" href="{{ route('admin.statistics') }}">
                            <i class="fas fa-chart-bar mr-2"></i> Thống kê
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white active" href="{{ route('admin.messages') }}">
                            <i class="fas fa-envelope mr-2"></i> Nhận thông điệp
                        </a>
                    </li>
                </ul>
            </div>
            
            <!-- Main content -->
            <div class="col-md-10 py-4">
                <h1 class="mb-4">Nhận thông điệp</h1>
                
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Danh sách tin nhắn</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Người gửi</th>
                                        <th>Tiêu đề</th>
                                        <th>Tin nhắn</th>
                                        <th>Ngày gửi</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($messages as $message)
                                        <tr>
                                            <td>{{ $message->id }}</td>
                                            <td>{{ $message->user ? $message->user->name : 'Khách' }}</td>
                                            <td>{{ $message->subject ?? 'Không có tiêu đề' }}</td>
                                            <td>{{ \Illuminate\Support\Str::limit($message->message, 50) }}</td>
                                            <td>{{ $message->created_at }}</td>
                                            <td>
                                                <button class="btn btn-sm btn-info view-message" data-toggle="modal" data-target="#messageModal" data-id="{{ $message->id }}" data-message="{{ $message->message }}">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <a href="#" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Không có tin nhắn nào</td>
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
    
    <!-- Message Modal -->
    <div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="messageModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="messageModalLabel">Chi tiết tin nhắn</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="modalMessageContent"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <script>
        // View message in modal
        $('.view-message').click(function() {
            var message = $(this).data('message');
            $('#modalMessageContent').text(message);
        });
    </script>
</body>
</html> 