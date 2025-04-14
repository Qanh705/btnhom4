<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Đăng ký</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

@include('components.user_header')

<section class="form-container">

   @if(session('message'))
      <div style="color:red;">{{ session('message') }}</div>
   @endif

   <form action="{{ route('register.submit') }}" method="POST">
      @csrf
      <h3>Đăng ký</h3>
      <input type="text" name="name" required placeholder="Vui lòng nhập tên..." class="box" maxlength="50">
      <input type="email" name="email" required placeholder="Vui lòng email..." class="box" maxlength="50">
      <input type="number" name="number" required placeholder="Vui lòng nhập số điện thoại..." class="box" min="0" max="9999999999" maxlength="10">
      <input type="password" name="pass" required placeholder="Vui lòng nhập mật khẩu..." class="box">
      <input type="password" name="cpass" required placeholder="Vui lòng xác nhận lại mật khẩu..." class="box">
      <input type="submit" value="đăng ký" name="submit" class="btn">
      <p>Bạn đã có tài khoản? <a href="{{ url('/login') }}">Đăng nhập</a></p>
   </form>

</section>

@include('components.footer')

</body>
</html>