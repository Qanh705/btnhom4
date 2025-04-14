<!DOCTYPE html>
<html lang="vi">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Cập nhật địa chỉ</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

   {{-- Header --}}
<x-user_header />

<section class="form-container update-form">
   <form action="{{ route('update_profile') }}" method="POST">
      @csrf
      <h3>Thông tin cá nhân</h3>

      {{-- Hiển thị thông báo thành công --}}
      @if (session('success'))
         <p style="color: green; margin-bottom: 10px;">{{ session('success') }}</p>
      @endif

      {{-- Hiển thị lỗi --}}
      @if ($errors->any())
         <ul style="color: red; margin-bottom: 10px;">
            @foreach ($errors->all() as $error)
               <li>{{ $error }}</li>
            @endforeach
         </ul>
      @endif

      <input 
         type="text" 
         name="name" 
         placeholder="{{ $user->name }}" 
         value="{{ old('name', $user->name) }}" 
         class="box" 
         maxlength="50"
      >

      <input 
         type="email" 
         name="email" 
         placeholder="{{ $user->email }}" 
         value="{{ old('email', $user->email) }}" 
         class="box" 
         maxlength="50"
      >

      <input 
         type="number" 
         name="number" 
         placeholder="{{ $user->number }}" 
         value="{{ old('number', $user->number) }}" 
         class="box" 
         maxlength="10"
      >

      <input 
         type="password" 
         name="old_pass" 
         placeholder="Vui lòng nhập mật khẩu cũ..." 
         class="box" 
         maxlength="50"
      >

      <input 
         type="password" 
         name="new_pass" 
         placeholder="Vui lòng nhập mật khẩu mới..." 
         class="box" 
         maxlength="50"
      >

      <input 
         type="password" 
         name="confirm_pass" 
         placeholder="Vui lòng xác nhận lại mật khẩu mới..." 
         class="box" 
         maxlength="50"
      >

      <input type="submit" value="Cập nhật" class="btn">
   </form>
</section>

<x-footer />
<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>