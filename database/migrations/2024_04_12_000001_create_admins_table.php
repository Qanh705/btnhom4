<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name', 20);
            $table->string('password', 50);
            $table->timestamps();
        });

        // Tạo tài khoản admin mặc định
        DB::table('admins')->insert([
            'name' => 'admin',
            'password' => sha1('111'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('admins');
    }
}; 