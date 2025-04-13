<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký</title>
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
            background: #007bff;
            color: white;
            border: none;
            padding: 12px;
            cursor: pointer;
            font-weight: 500;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .form-container input[type="submit"]:hover {
            background: #0056b3;
        }

        .message {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            background: #fff;
            padding: 15px 25px;
            border-radius: 4px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .message span {
            color: #dc3545;
        }

        .message i {
            cursor: pointer;
            color: #666;
        }
        
        .login-link {
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
        }
        
        .login-link a {
            color: #007bff;
            text-decoration: none;
        }
        
        .login-link a:hover {
            text-decoration: underline;
        }
        
        .error-message {
            color: #dc3545;
            font-size: 12px;
            margin-top: -10px;
            margin-bottom: 10px;
        }
        
        .alert {
            padding: 10px 15px;
            border-radius: 4px;
            margin-bottom: 20px;
            font-size: 14px;
        }
        
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
    @if(session('error'))
        <div class="message">
            <span>{{ session('error') }}</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
        </div>
    @endif

    <div class="form-container">
        <form action="{{ route('register.post') }}" method="POST">
            @csrf
            <h3>Đăng Ký</h3>
            
            @if($errors->has('error'))
                <div class="alert alert-danger">
                    {{ $errors->first('error') }}
                </div>
            @endif
            
            <input type="text" name="name" value="{{ old('name') }}" required placeholder="Họ và tên...">
            @error('name')
                <div class="error-message">{{ $message }}</div>
            @enderror
            
            <input type="email" name="email" value="{{ old('email') }}" required placeholder="Email...">
            @error('email')
                <div class="error-message">{{ $message }}</div>
            @enderror
            
            <input type="password" name="password" required placeholder="Mật khẩu...">
            @error('password')
                <div class="error-message">{{ $message }}</div>
            @enderror
            
            <input type="password" name="password_confirmation" required placeholder="Xác nhận mật khẩu...">
            
            <input type="submit" value="Đăng Ký">
            <div class="login-link">
                Đã có tài khoản? <a href="{{ route('login') }}">Đăng nhập ngay</a>
            </div>
        </form>
    </div>
</body>
</html> 