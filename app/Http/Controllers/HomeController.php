<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // lấy random 6 sản phẩm để hiện 
        $products = DB::table('products')->inRandomOrder()->limit(6)->get();

        return view('home', ['products'=> $products]); //gửi dlieu product vào view và đặt tên 
    }
    public function about()
    {
        return view('about');
    }
    public function contact(Request $request)
    {
        $user_id = session('user_id') ?? null;

        if ($request->isMethod('post')) {
            $data = $request->only(['name', 'email', 'number', 'msg']);

            $tontai = DB::table('messages')
                        ->where('name', $data['name'])
                        ->where('email', $data['email'])
                        ->where('number', $data['number'])
                        ->where('message', $data['msg'])
                        ->exists(); 

            if ($tontai) {
                return view('contact', ['message' => 'Tin nhắn đã có rồi']);
            }

            DB::table('messages')->insert([
                'user_id' => $user_id,  // Gán giá trị user_id là NULL nếu không có session
                'name' => $data['name'],
                'email' => $data['email'],
                'number' => $data['number'],
                'message' => $data['msg'],
            ]);

            return view('contact', ['message' => 'Đã gửi tin nhắn thành công']);
        }

        return view('contact');
    }
    public function search(Request $request)
    {
        $search_box = $request->input('search_box');

        $products = [];

        if ($search_box) {
            $products = Product::where('name', 'LIKE', "%{$search_box}%")->get();
        }

        return view('search', compact('products', 'search_box'));
    }


}
