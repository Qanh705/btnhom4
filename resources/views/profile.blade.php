<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Thông tin</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
@if(session('success'))
   <div id="success-message" class="custom-alert">
      <span>{{ session('success') }}</span>
      <button class="close-alert" onclick="closeAlert()">✖</button>
   </div>
@endif

<style>
   .custom-alert {
      background-color: #ffd835;
      color: #222;
      padding: 15px 20px;
      border-radius: 6px;
      font-size: 16px;
      font-weight: 500;
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin: 10px auto;
      max-width: 1000px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      position: relative;
   }

   .close-alert {
      background: none;
      border: none;
      font-size: 20px;
      color: #d8000c;
      cursor: pointer;
      padding: 0;
      margin-left: 10px;
   }

   .close-alert:hover {
      color: #a00000;
   }
</style>

<script>
   function closeAlert() {
      const alert = document.getElementById('success-message');
      if (alert) alert.style.display = 'none';
   }
   setTimeout(() => {
      closeAlert();
   }, 3000);
</script>
@include('components.user_header')

<section class="user-details">

   <div class="user">
      <img src="{{ asset('images/user-icon.png') }}" alt="">

      <p><i class="fas fa-user"></i><span>{{ $fetch_profile->name }}</span></p>
      <p><i class="fas fa-phone"></i><span>{{ $fetch_profile->number }}</span></p>
      <p><i class="fas fa-envelope"></i><span>{{ $fetch_profile->email }}</span></p>
      <b><a href="{{ url('update_profile') }}" class="btn">Cập nhật thông tin</a></b>

      <p class="address">
         <i class="fas fa-map-marker-alt"></i>
         <span>
            {{ $fetch_profile->address ? $fetch_profile->address : 'vui lòng thêm địa chỉ' }}
         </span>
      </p>
      <b><a href="{{ url('update_address') }}" class="btn">Cập nhật địa chỉ</a></b>
   </div>

</section>

@include('components.footer')
<script src="{{ asset('js/script.js') }}"></script>

</body>
</html>