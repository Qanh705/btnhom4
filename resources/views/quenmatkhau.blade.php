<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

@include('components.user_header')

<section class="form-container">
   @if(session('message'))
      <div style="color: green;">{{ session('message') }}</div>
   @endif

   <form action="{{ route('quenmatkhau.update') }}" method="POST">
      @csrf
      <h3>cài đặt mật khẩu</h3>
      <input type="email" name="email" required placeholder="Vui lòng nhập email..." class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="new_pass" required placeholder="Vui lòng nhập mật khẩu mới..." class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="cập nhật" name="submit" class="btn">
   </form>
</section>

@include('components.footer')

<script src="{{ asset('js/script.js') }}"></script>

</body>
</html>