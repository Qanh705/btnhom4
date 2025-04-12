<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Lấy toàn bộ sản phẩm 
        $products = DB::table('products')->inRandomOrder()->limit(6)->get();

        return view('home', ['products'=> $products]); //// Gửi dữ liệu $products vào view, với tên biến là 'products'
    }
    public function about()
    {
        return view('about');
    }
}
