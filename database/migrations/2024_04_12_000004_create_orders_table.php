<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name', 20);
            $table->string('number', 10);
            $table->string('email', 50);
            $table->string('method', 50);
            $table->string('address', 500);
            $table->string('total_products', 1000);
            $table->integer('total_price');
            $table->string('payment_status', 20)->default('pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}; 