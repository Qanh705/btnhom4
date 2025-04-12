<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Liên hệ</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
@include('components.user_header')

<div class="heading">
   <h3>liên hệ</h3>
   <p><a href="{{ url('/') }}">Trở về trang chủ</a></p>
</div>

<section class="contact">
   <div class="row">

      <div class="image">
         <img src="{{ asset('images/contact.jpg') }}" alt="">
      </div>

      <form action="" method="post">
      @csrf
         <h3>Hãy liên hệ với chúng tôi nhé!</h3><br>
         <p style="font-size: 18px";>Để lại số điện thoại và thắc mắc của bạn, chúng tôi sẽ gọi điện tư vấn trực tiếp.</p>
         <input type="text" name="name" maxlength="50" class="box" placeholder="Vui lòng nhập tên của bạn" required>
         <input type="number" name="number" min="0" max="9999999999" class="box" placeholder="Vui lòng nhập số điện thoại của bạn" required maxlength="10">
         <input type="email" name="email" maxlength="50" class="box" placeholder="Vui lòng nhập email của bạn" required>
         <textarea name="msg" class="box" required placeholder="Hãy nói gì đó với chúng tôi" maxlength="500" cols="30" rows="10"></textarea>
         <input type="submit" value="Gửi" name="send" class="btn">
      </form>

   </div>
</section>
@include('components.footer')
<script src="{{ asset('js/script.js') }}"></script>

</body>
</html>