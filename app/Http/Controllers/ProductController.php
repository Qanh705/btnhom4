<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function goiY()
    {
        $products = DB::table('products')->inRandomOrder()->get();
        return view('goi_y', compact('products'));
    }
    
    

    
}
