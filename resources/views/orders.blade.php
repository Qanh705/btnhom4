<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Đơn hàng</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="{{ asset('css/style.css') }}">
   <style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-size: 18px;
        color: #333;
        background-color: #f9f9f9;
        margin: 0;
        padding: 0;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 30px;
        font-size: 17px;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 18px;
        text-align: center;
    }

    th {
        background-color: #f2f2f2;
        font-weight: bold;
        font-size: 18px;
    }

    td {
        font-size: 17px;
    }

    .icon-eye {
        color: green;
        cursor: pointer;
        font-size: 20px;
    }

    .pagination {
        margin-top: 25px;
        text-align: center;
        font-size: 17px;
    }

    .pagination a {
        display: inline-block;
        padding: 10px 18px;
        margin: 0 5px;
        background-color: #f0f0f0;
        border-radius: 6px;
        text-decoration: none;
        color: black;
        transition: 0.3s;
    }

    .pagination a:hover {
        background-color: #ddd;
    }

    .pagination .active {
        background-color: orange;
        color: white;
        font-weight: bold;
    }
</style>
</head>
<body>
@include ('components.user_header')
<div class="heading">
    <h3>Đơn hàng</h3>
    <p><a href="{{ url('/') }}">Trở về trang chủ</a></p>
</div>
<section class="orders" style="padding: 20px;">
        <div class="box-container">
            @if ($orders->count() > 0)
                <table style="width: 100%; border-collapse: collapse; margin-top: 30px; font-size: 17px;">
                    <thead>
                        <tr style="background-color: #f2f2f2; font-weight: bold; font-size: 18px;">
                            <th style="padding: 18px; border: 1px solid #ddd;">Thứ tự</th>
                            <th style="padding: 18px; border: 1px solid #ddd;">Mã đơn hàng</th>
                            <th style="padding: 18px; border: 1px solid #ddd;">Ngày đặt</th>
                            <th style="padding: 18px; border: 1px solid #ddd;">Tình trạng</th>
                            <th style="padding: 18px; border: 1px solid #ddd;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $index => $order)
                            <tr>
                                <td style="padding: 18px; border: 1px solid #ddd;">{{ $offset + $index + 1 }}</td>
                                <td style="padding: 18px; border: 1px solid #ddd;">{{ substr($order->id, 0, 5) }}</td>
                                <td style="padding: 18px; border: 1px solid #ddd;">{{ $order->created_at }}</td>
                                <td style="padding: 18px; border: 1px solid #ddd;">{{ $order->payment_status }}</td>
                                <td style="padding: 18px; border: 1px solid #ddd;">
                                    <a href="{{ url('/orders/detail?id=' . $order->id) }}">
                                        <i class="fas fa-eye" style="color: green; font-size: 20px;"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="pagination" style="text-align: center; margin-top: 25px; font-size: 17px;">
                    @for ($p = 1; $p <= $totalPages; $p++)
                        <a href="{{ url('orders?page=' . $p) }}"
                           class="{{ $p == $currentPage ? 'active' : '' }}"
                           style="display: inline-block; padding: 10px 18px; margin: 0 5px; background-color: {{ $p == $currentPage ? 'orange' : '#f0f0f0' }}; color: {{ $p == $currentPage ? 'white' : 'black' }}; border-radius: 6px; text-decoration: none; font-weight: {{ $p == $currentPage ? 'bold' : 'normal' }};">
                            {{ $p }}
                        </a>
                    @endfor
                </div>
            @else
                <p class="empty">Không có đơn hàng nào!</p>
            @endif
        </div>
    </section>
  @include('components.footer')
  <script src="{{ asset('js/script.js') }}"></script>
  </body>
</html>