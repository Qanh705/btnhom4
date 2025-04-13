<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f5f5f5;
        }

        .form-container {
            background: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .form-container h3 {
            color: #2B4865;
            font-size: 24px;
            text-align: center;
            margin-bottom: 30px;
            font-weight: 600;
        }

        .form-container input {
            width: 100%;
            padding: 12px 15px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            transition: border-color 0.3s ease;
        }

        .form-container input:focus {
            outline: none;
            border-color: #007bff;
        }

        .form-container input[type="submit"] {
            background: #343a40;
            color: white;
            border: none;
            padding: 12px;
            cursor: pointer;
            font-weight: 500;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .form-container input[type="submit"]:hover {
            background: #23272b;
        }

        .message {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            padding: 15px 25px;
            border-radius: 4px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 10px;
            z-index: 100;
        }

        .error-message {
            background: #f8d7da;
            color: #721c24;
        }

        .success-message {
            background: #d4edda;
            color: #155724;
        }

        .message i {
            cursor: pointer;
        }

        .error-text {
            color: #dc3545;
            font-size: 12px;
            margin-top: -10px;
            margin-bottom: 10px;
        }

        .admin-icon {
            text-align: center;
            margin-bottom: 20px;
        }

        .admin-icon i {
            font-size: 48px;
            color: #343a40;
        }
    </style>
</head>
<body>
    @if(session('error'))
        <div class="message error-message">
            <span>{{ session('error') }}</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
        </div>
    @endif

    @if(session('success'))
        <div class="message success-message">
            <span>{{ session('success') }}</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
        </div>
    @endif

    <div class="form-container">
        <div class="admin-icon">
            <i class="fas fa-user-shield"></i>
        </div>
        <h3>Đăng Nhập Admin</h3>
        <form action="{{ route('admin.login') }}" method="POST">
            @csrf
            <input type="text" name="name" value="{{ old('name') }}" maxlength="20" required placeholder="Tên đăng nhập...">
            @error('name')
                <div class="error-text">{{ $message }}</div>
            @enderror
            
            <input type="password" name="pass" maxlength="20" required placeholder="Mật khẩu...">
            @error('pass')
                <div class="error-text">{{ $message }}</div>
            @enderror
            
            <input type="submit" value="Đăng Nhập">
        </form>
    </div>
</body>
</html> 