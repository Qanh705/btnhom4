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

   <section class="form-container">
      <form action="{{ route('update_address') }}" method="post">
         @csrf
         <h3>Thông tin địa chỉ</h3>

         <input type="text" name="flat" class="box" placeholder="Số phòng..." required maxlength="50" value="{{ old('flat') }}">
         <input type="text" name="building" class="box" placeholder="Số nhà..." required maxlength="50" value="{{ old('building') }}">
         <input type="text" name="area" class="box" placeholder="Tên đường..." required maxlength="50" value="{{ old('area') }}">
         <input type="text" name="town" class="box" placeholder="Tên phường..." required maxlength="50" value="{{ old('town') }}">
         <input type="text" name="city" class="box" placeholder="Tên quận..." required maxlength="50" value="{{ old('city') }}">
         <input type="text" name="state" class="box" placeholder="Tên thành phố..." required maxlength="50" value="{{ old('state') }}">
         <input type="text" name="country" class="box" placeholder="Tên đất nước..." required maxlength="50" value="{{ old('country') }}">
         
         <input type="submit" value="Lưu" class="btn">
      </form>
   </section>

   {{-- Footer --}}
   <x-footer />

   <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>