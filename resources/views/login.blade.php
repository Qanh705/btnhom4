<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Đăng nhập</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>
<body>

@include('components.user_header')

<section class="form-container">
   
   <form action="{{ url('/login') }}" method="post">
      @csrf
      <h3>Đăng nhập</h3>

      @if(session('error'))
         <div style="color: red; margin-bottom: 10px;">{{ session('error') }}</div>
      @endif

      <input type="email" name="email" value="{{ old('email') }}" required placeholder="Vui lòng nhập email" class="box" maxlength="50">
      <input type="password" name="pass" required placeholder="Vui lòng nhập mật khẩu" class="box" maxlength="50"> 
      <input type="submit" value="Đăng nhập" name="submit" class="btn">

      <div class="more-btn">
         <a href="{{ url('quenmatkhau') }}" class="btn">Quên mật khẩu?</a>
      </div>

      <p>Bạn chưa có tài khoản? <a href="{{ url('register') }}">Đăng ký</a></p>
   </form>
</section>

@include('components.footer')
<script src="{{ asset('js/script.js') }}"></script>

</body>
</html>