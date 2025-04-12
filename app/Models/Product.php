<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'price',
        'image',
        'des'
    ];
    
    /**
     * Lấy các đơn hàng chứa sản phẩm này
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_items', 'product_id', 'order_id');
    }
}
