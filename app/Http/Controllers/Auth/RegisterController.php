<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|max:20|confirmed',
        ]);

        try {
            // Thử tạo người dùng trực tiếp qua DB để tránh hash quá dài
            $userId = DB::table('users')->insertGetId([
                'name' => $request->name,
                'email' => $request->email,
                'password' => substr(Hash::make($request->password), 0, 60), // Giới hạn độ dài chuỗi hash
            ]);
            
            $user = User::find($userId);
            Auth::login($user);
            
            return redirect('/')->with('success', 'Đăng ký thành công!');
        } catch (\Exception $e) {
            return back()->withInput($request->except('password'))
                        ->withErrors(['error' => 'Đăng ký thất bại: ' . $e->getMessage()]);
        }
    }
} 