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
    public function chitiet($id)
    {
        $product = DB::table('products')->where('id', $id)->first();

        if (!$product) {
            abort(404); //error: san pham khong ton tai
        }

        return view('quick_view', compact('product'));
    }
 
}
