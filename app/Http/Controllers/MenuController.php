<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class MenuController extends Controller
{
    public function index()
    {
        $user_id = Session::get('user_id') ?? '';
        $products = DB::table('products')->get();

        return view('menu.index', compact('products', 'user_id'));
    }

    public function buyNow(Request $request)
    {
        $user_id = Session::get('user_id');

        if (!$user_id) {
            return redirect('login');
        }

        DB::table('cart')->insert([
            'user_id' => $user_id,
            'pid' => $request->pid,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->qty,
            'image' => $request->image
        ]);

        return redirect('checkout');
    }
}
