<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        // Nếu đã đăng nhập thì chuyển hướng đến dashboard
        if (Session::has('admin_id')) {
            return redirect('/admin/dashboard');
        }

        // Kiểm tra nếu bảng admins tồn tại
        if (Schema::hasTable('admins')) {
            // Kiểm tra nếu không có tài khoản admin nào, tạo tài khoản mặc định
            if (Admin::count() === 0) {
                Admin::create([
                    'name' => 'admin',
                    'password' => sha1('111')
                ]);
            }
        }
        
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'pass' => 'required'
        ]);

        $admin = Admin::where('name', $request->name)->first();

        if ($admin && sha1($request->pass) === $admin->password) {
            Session::put('admin_id', $admin->id);
            Session::put('admin_name', $admin->name);
            return redirect('/admin/dashboard');
        } else {
            return back()->with('error', 'Thông tin đăng nhập không đúng! Vui lòng nhập lại');
        }
    }
    
    public function logout()
    {
        Session::forget(['admin_id', 'admin_name']);
        return redirect('/admin/login')->with('success', 'Đăng xuất thành công');
    }
} 