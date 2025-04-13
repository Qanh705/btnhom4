<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Xóa dữ liệu cũ nếu có
        DB::table('products')->truncate();
        
        // Tạo dữ liệu mẫu cho sản phẩm iPhone
        $products = [
            [
                'name' => 'iPhone 15 Pro Max',
                'price' => 40000000,
                'image' => 'iphone15promax.jpg',
                'category' => 'iphone',
                'des' => 'Điện thoại cao cấp nhất của Apple với chip A17 Pro và camera 48MP'
            ],
            [
                'name' => 'iPhone 15 Pro',
                'price' => 35000000,
                'image' => 'iphone15pro.jpg',
                'category' => 'iphone',
                'des' => 'Phiên bản cao cấp của iPhone 15 với chip A17 Pro'
            ],
            [
                'name' => 'iPhone 15',
                'price' => 30000000,
                'image' => 'iphone15.jpg',
                'category' => 'iphone',
                'des' => 'iPhone thế hệ mới với hiệu năng mạnh mẽ'
            ],
            [
                'name' => 'iPhone 15 Plus',
                'price' => 25000000,
                'image' => 'iphone15plus.jpg',
                'category' => 'iphone',
                'des' => 'iPhone 15 với màn hình lớn hơn'
            ],
            [
                'name' => 'iPhone 14 Pro Max',
                'price' => 32000000,
                'image' => 'iphone14promax.jpg',
                'category' => 'iphone',
                'des' => 'iPhone 14 Pro Max với chip A16 Bionic'
            ],
            [
                'name' => 'iPhone 14 Pro',
                'price' => 28000000,
                'image' => 'iphone14pro.jpg',
                'category' => 'iphone',
                'des' => 'iPhone 14 Pro với Dynamic Island'
            ],
            
            // Samsung
            [
                'name' => 'Samsung Galaxy S23',
                'price' => 22990000,
                'image' => 'samsungs23.jpg',
                'category' => 'samsung',
                'des' => 'Flagship của Samsung với camera 200MP'
            ],
            [
                'name' => 'Samsung Galaxy Z Fold6',
                'price' => 44990000,
                'image' => 'zfold6.jpg',
                'category' => 'samsung',
                'des' => 'Điện thoại màn hình gập cao cấp nhất của Samsung'
            ],
            [
                'name' => 'Samsung Galaxy Z Flip6',
                'price' => 27990000,
                'image' => 'zflip6.jpg',
                'category' => 'samsung',
                'des' => 'Điện thoại gập vỏ sò tiện lợi'
            ],
            [
                'name' => 'Samsung Galaxy A55',
                'price' => 8990000,
                'image' => 'galaxya55.jpg',
                'category' => 'samsung',
                'des' => 'Điện thoại tầm trung với hiệu năng mạnh'
            ],
            [
                'name' => 'Samsung Galaxy A16',
                'price' => 4790000,
                'image' => 'galaxya16.jpg',
                'category' => 'samsung',
                'des' => 'Điện thoại giá rẻ với pin lớn'
            ],
            [
                'name' => 'Samsung Galaxy S24',
                'price' => 18990000,
                'image' => 'galaxys24.jpg',
                'category' => 'samsung',
                'des' => 'Flagship mới nhất với AI tích hợp'
            ],
            
            // OPPO
            [
                'name' => 'OPPO Find X6 Pro',
                'price' => 25990000,
                'image' => 'oppofindx6pro.jpg',
                'category' => 'oppo',
                'des' => 'Flagship của OPPO với camera Hasselblad'
            ],
            [
                'name' => 'OPPO Reno10 Pro',
                'price' => 15990000,
                'image' => 'opppreno10pro.jpg',
                'category' => 'oppo',
                'des' => 'Điện thoại tầm trung cao cấp với camera chân dung xuất sắc'
            ],
            
            // Sony
            [
                'name' => 'Sony Xperia 1 V',
                'price' => 29990000,
                'image' => 'sonyxperia1v.jpg',
                'category' => 'sony',
                'des' => 'Flagship của Sony với màn hình 4K và camera chuyên nghiệp'
            ],
            [
                'name' => 'Sony Xperia 10 V',
                'price' => 9990000,
                'image' => 'sonyxperia10v.jpg',
                'category' => 'sony',
                'des' => 'Điện thoại tầm trung với màn hình 21:9 đặc trưng'
            ],
        ];
        
        // Chèn dữ liệu vào bảng products
        DB::table('products')->insert($products);
    }
} 