<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Tạo tài khoản admin với tên đăng nhập là admin và mật khẩu là 111
        DB::table('admins')->insert([
            'name' => 'admin',
            'password' => sha1('111'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
