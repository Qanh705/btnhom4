<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Gọi AdminSeeder để tạo tài khoản admin
        $this->call(AdminSeeder::class);
        
        // Tạo dữ liệu mẫu cho sản phẩm
        $this->call(ProductSeeder::class);
    }
}
