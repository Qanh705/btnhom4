<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .checkout {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 100vh;
        }

        .qr-code {
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .qr-code .image img {
            width: 200px;
            height: 200px;
            margin-bottom: 20px;
        }

        .qr-code form {
            margin-top: 20px;
            text-align: center;
        }

        .qr-code .input-box {
            margin-bottom: 10px;
        }

        .qr-code input[type="text"] {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 200px;
            font-size: 16px;
        }

        .qr-code .btn {
            padding: 10px 20px;
            background: var(--red);
            color: #fff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
        }

        .qr-code .btn:hover {
            background: #c0392b;
        }

        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>

@include('components.user_header')

<div class="heading">
    <h3>Thanh toán</h3>
    <p><a href="{{ url('/') }}">Trở về trang chủ</a></p>
</div>

<section class="checkout" style="display:flex;flex-direction:column;align-items:center;justify-content:center;height:80vh;">
    <h1 class="title">Mã QR thanh toán</h1>
    <div class="qr-code" style="background:#f9f9f9;padding:20px;border-radius:10px;text-align:center;box-shadow:0 4px 8px rgba(0,0,0,0.1);">
        <div class="image" style="margin-bottom:20px;">
            <img src="{{ asset('images/QR.jpg') }}" alt="QR Code" style="width:200px;height:200px;">
        </div>

        <form method="POST" action="{{ url('/qrcode/confirmPayment') }}">
            @csrf
            <div class="input-box" style="margin-bottom:10px;">
            <label for="payment_code" style="font-size: 20px;">Nhập mã xác nhận:</label><br>
            <input type="text" name="payment_code" id="payment_code" required style="padding:8px;border-radius:5px;border:1px solid #ccc;width:200px;">
            </div>
            <button type="submit" class="btn" style="padding:10px 20px;background:#e74c3c;color:white;border:none;border-radius:5px;">Xác nhận</button>
        </form>

        @if(session('error'))
            <p style="color:red;margin-top:10px;">{{ session('error') }}</p>
        @endif
    </div>
</section>

@include('components.footer')
<script src="{{ asset('js/script.js') }}"></script>

</body>
</html>