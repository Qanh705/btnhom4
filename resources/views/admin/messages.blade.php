@extends('layouts.admin')

@section('title', 'Nhận thông điệp')

@section('content')
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
@endsection

@section('scripts')
<script>
    // View message in modal
    $('.view-message').click(function() {
        var message = $(this).data('message');
        $('#modalMessageContent').text(message);
    });
</script>
@endsection 