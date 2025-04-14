<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    public function formregister()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'   => 'required|string|max:50',
            'email'  => 'required|email|max:50',
            'number' => 'required|numeric|digits_between:8,10',
            'pass'   => 'required|string',
            'cpass'  => 'required|string|same:pass',
        ]);

        $name = $request->name;
        $email = $request->email;
        $number = $request->number;
        $pass = $request->pass;

        $existing = DB::table('users')
            ->where('email', $email)
            ->orWhere('number', $number)
            ->first();

        if ($existing) {
            return back()->with('message', 'Email hoặc số điện thoại đã được sử dụng!');
        }

        DB::table('users')->insert([
            'name' => $name,
            'email' => $email,
            'number' => $number,
            'password' => $pass 
        ]);

        $user = DB::table('users')
            ->where('email', $email)
            ->where('password', $pass)
            ->first();

        if ($user) {
            Session::put('user_id', $user->id);
            return redirect('/');
        }

        return back()->with('message', 'Lỗi khi tạo tài khoản!');
    }
}
