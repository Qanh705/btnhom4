<!DOCTYPE html>
<html lang="vi">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Chi tiết đơn hàng</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="{{ asset('css/style.css') }}">
   <style>
      body {
         font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
         background-color: #f9f9f9;
         color: #333;
         line-height: 1.6;
         margin: 0;
         padding: 0;
      }

      .section {
         max-width: 1000px;
         margin: 30px auto;
         background: #fff;
         border-radius: 8px;
         box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
         padding: 30px;
         border-left: 6px solid #ffaa00;
      }

      .section h3 {
         color: #444;
         font-size: 22px;
         margin-bottom: 15px;
         border-bottom: 2px solid #eee;
         padding-bottom: 5px;
      }

      .section p {
         font-size: 16px;
         margin: 8px 0;
      }

      .section span {
         font-weight: bold;
         color: #555;
      }

      table {
         width: 100%;
         border-collapse: collapse;
         margin-top: 20px;
         font-size: 15px;
      }

      table th, table td {
         border: 1px solid #ddd;
         padding: 12px 15px;
         text-align: left;
      }

      table th {
         background-color: #f4f4f4;
         color: #222;
      }

      table tr:nth-child(even) {
         background-color: #f9f9f9;
      }

      .total-box {
         margin-top: 20px;
         font-size: 17px;
         font-weight: bold;
         color: #000;
      }

      .back-link {
         text-align: right;
         margin-top: 25px;
      }

      .back-link a {
         display: inline-block;
         padding: 10px 18px;
         background: #ffaa00;
         color: white;
         text-decoration: none;
         font-weight: 600;
         border-radius: 5px;
         transition: 0.3s ease;
      }

      .back-link a:hover {
         background: #e69b00;
      }
   </style>
</head>
<body>
@include('components.user_header')

<div class="section">
    <h3>Thông tin khách hàng</h3>
    <p>Tên khách hàng: <span>{{ $order->name }}</span></p>
    <p>Số điện thoại: <span>{{ $order->number }}</span></p>
    <p>Email: <span>{{ $order->email }}</span></p>
</div>

<div class="section">
    <h3>Thông tin vận chuyển</h3>
    <p>Địa chỉ: <span>{{ $order->address }}</span></p>
    <p>Phương thức thanh toán: <span>{{ $order->method }}</span></p>
</div>

<div class="section">
    <h3>Chi tiết đơn hàng</h3>
    <table>
        <thead>
            <tr>
                <th>Mã đơn</th>
                <th>Sản phẩm</th>
                <th>Thời gian đặt</th>
                <th>Tình trạng</th>
                <th>Tổng tiền</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->total_products }}</td>
                <td>{{ date('d/m/Y H:i', strtotime($order->created_at)) }}</td>
                <td>{{ $order->payment_status }}</td>
                <td>{{ number_format($order->total_price, 0, ',', '.') }}đ</td>
            </tr>
        </tbody>
    </table>

    <div class="back-link">
        <a href="{{ url('/orders') }}">← Quay lại danh sách</a>
    </div>
</div>

@include('components.footer')
<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>