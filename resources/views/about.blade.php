
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Giới thiệu cửa hàng</title>
   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
@include('components.user_header')
   <div class="heading">
      <h3>Giới thiệu</h3>
      <p><a href="{{ url('/') }}">Trở về trang chủ</a></p>
   </div>

   <section class="about">
      <div class="row">
         <div class="image">
         <img src="{{ asset('hinhanh/about.jpg') }}" alt="">
         </div>
         <div class="content">
            <h3>Tại sao bạn nên chọn chúng tôi?</h3>
            <p>Chúng tôi cam kết mang đến cho bạn những sản phẩm điện thoại chính hãng với mức giá cạnh tranh nhất, đi kèm với dịch vụ chăm sóc khách hàng tận tâm, chế độ bảo hành uy tín, và hỗ trợ kỹ thuật trọn đời, giúp bạn yên tâm trải nghiệm công nghệ tối ưu nhất!</p>
            <a href="{{ url('/contact') }}" class="btn">Liên hệ</a>
         </div>
      </div>
   </section>

   <section class="steps">
      <h3 class="title">Nổi bật</h3>
      <div class="box-container">

         <div class="box">
            <img src="{{ asset('hinhanh/menu.png') }}" alt="">
            <h3>Đa dạng sản phẩm</h3>
            <p>Luôn cập nhật những mẫu mới nhất, công nghệ tiên tiến nhất.</p>
         </div>

         <div class="box">
            <img src="{{ asset('images/ship.png') }}" alt="">
            <h3>Giao hàng siêu tốc</h3>
            <p>Sản phẩm sẽ được giao đến bên bạn nhanh nhất khi cần.</p>
         </div>

         <div class="box">
            <img src="{{ asset('images/quanlity.jpg') }}" alt="">
            <h3>Chất lượng hàng đầu</h3>
            <p>Chúng tôi cung cấp điện thoại chính hãng, đảm bảo chất lượng vượt trội.</p>
         </div>
      </div>
   </section>

   <section class="about_reviews">
      <h1 class="about_title">Bình luận của khách hàng</h1>

      <div class="about_reviews-container">
         <div class="about_review">
            <div class="about_avatar">
               <img src="{{ asset('hinhanh/quynhanh.jpg') }}" alt="Quỳnh Anh kute">
            </div>
            <div class="about_review-content">

               <h3 class="about_reviewer">Quỳnh Anh kute</h3>
               <div class="about_stars">
                  <span>★★★★★</span>
               </div>
               <p class="about_comment">Điện thoại chính hãng, giá tốt hơn nhiều so với những nơi khác. Giao hàng cực nhanh và đóng gói rất cẩn thận. Nhân viên cùng tên tui thật tuyệt vời.Sẽ quay lại ủng hộ!</p>

            </div>
         </div>

         <div class="about_review">
            <div class="about_avatar">
               <img src="{{ asset('hinhanh/camly.jpg') }}" alt="Cẩm Ly giỏi giang">
            </div>
            <div class="about_review-content">

               <h3 class="about_reviewer">Cẩm Ly giỏi giang</h3>
               <div class="about_stars">
                  <span>★★★★☆</span>
               </div>
               <p class="about_comment">Sản phẩm đúng mô tả, nguyên seal và đầy đủ phụ kiện. Nhân viên tư vấn nhiệt tình, nhưng giao hàng chậm hơn dự kiến một chút. Nhìn chung rất hài lòng!</p>

            </div>
         </div>

         <div class="about_review">
            <div class="about_avatar">
               <img src="{{ asset('hinhanh/hangny.jpg') }}" alt="Hằng Ny cool">
            </div>
            <div class="about_review-content">

               <h3 class="about_reviewer">Hằng Ny cool</h3>
               <div class="about_stars">
                  <span>★★★★★</span>
               </div>
               <p class="about_comment">Mua máy ở đây an tâm vì có bảo hành chính hãng. Máy chạy mượt, pin khỏe. Đặc biệt thích dịch vụ hỗ trợ khách hàng sau mua, rất chuyên nghiệp!</p>

            </div>
         </div>

         <div class="about_review">
            <div class="about_avatar">
               <img src="{{ asset('hinhanh/phuongnga.jpg') }}" alt="Phương Nga thích học code">
            </div>
            <div class="about_review-content">
               <h3 class="about_reviewer">Phương Nga thích học code</h3>
               <div class="about_stars">
                  <span>★★★★☆</span>
               </div>
               <p class="about_comment">Sản phẩm đúng chuẩn, giá hợp lý. Máy dùng ổn định, chụp ảnh đẹp. Mình thích chính sách đổi trả rõ ràng, tuy nhiên nếu thêm quà tặng nhỏ sẽ tốt hơn!</p>

            </div>
         </div>

         <div class="about_review">
            <div class="about_avatar">
               <img src="{{ asset('hinhanh/bao.jpg') }}" alt="Bảo best">
            </div>
            <div class="about_review-content">
               <h3 class="about_reviewer">Bảo best</h3>
               <div class="about_stars">
                  <span>★★★★☆</span>
               </div>
               <p class="about_comment">Máy mới tinh, giao siêu nhanh. Mình rất ấn tượng với cách cửa hàng chăm sóc khách hàng, nhắn tin hỏi thăm và hỗ trợ cài đặt nữa. Rất đáng tiền!</p>

            </div>
         </div>

         <div class="about_review">
            <div class="about_avatar">
            <img src="{{ asset('hinhanh/quynh.jpg') }}" alt="Quỳnh mê Trí Son">
            </div>
            <div class="about_review-content">
               <h3 class="about_reviewer">Quỳnh mê Trí Son</h3>
               <div class="about_stars">
                  <span>★★★★☆</span>
               </div>
               <p class="about_comment">Điện thoại dùng rất tốt, đúng như quảng cáo. Có lẽ cần cải thiện khâu cập nhật thông tin giao hàng, nhưng về chất lượng sản phẩm thì không chê được!</p>

            </div>
         </div>
      </div>
   </section>

   @include('components.footer')

   <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
   <script src="{{ asset('js/script.js') }}"></script>

   <script>
      var swiper = new Swiper(".reviews-slider", {
         loop: true,
         grabCursor: true,
         spaceBetween: 20,
         pagination: {
            el: ".swiper-pagination",
            clickable: true,
         },
         breakpoints: {
            0: {
               slidesPerView: 1,
            },
            700: {
               slidesPerView: 2,
            },
            1024: {
               slidesPerView: 3,
            },
         },
      });
   </script>

</body>

</html>