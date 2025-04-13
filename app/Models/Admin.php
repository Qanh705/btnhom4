<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $table = 'admins';
    
    public $timestamps = true;
    
    protected $fillable = [
        'name',
        'password'
    ];

    protected $hidden = [
        'password'
    ];
    
    // Tắt timestamps nếu cần
    // public $timestamps = false;
}
