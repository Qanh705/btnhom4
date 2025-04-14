<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function show($category)
    {
        $products = DB::table('products')->where('category', $category)->get();
        return view('category', compact('products', 'category'));
    }
}
