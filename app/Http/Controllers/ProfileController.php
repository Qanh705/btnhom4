<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function profile()
    {
        $user_id = Session::get('user_id');

        if (!$user_id) {
            return redirect('/home');
        }

        $fetch_profile = DB::table('users')->where('id', $user_id)->first();

        return view('profile', compact('fetch_profile'));
    }

    public function editAddress()
    {
        $user_id = Session::get('user_id');
        if (!$user_id) {
            return redirect('/')->with('error', 'Bạn chưa đăng nhập!');
        }

        $user = DB::table('users')->where('id', $user_id)->first();

        if (!$user) {
            return redirect('/')->with('error', 'Không tìm thấy người dùng.');
        }

        return view('update_address', compact('user'));
    }

    public function updateAddress(Request $request)
    {
        $request->validate([
            'flat' => 'required|string|max:50',
            'building' => 'required|string|max:50',
            'area' => 'required|string|max:50',
            'town' => 'required|string|max:50',
            'city' => 'required|string|max:50',
            'state' => 'required|string|max:50',
            'country' => 'required|string|max:50',
        ]);

        $user_id = Session::get('user_id');
        if (!$user_id) {
            return redirect('/')->with('error', 'Bạn chưa đăng nhập!');
        }

        $address = $request->flat . ', ' . $request->building . ', ' . $request->area . ', ' .
                $request->town . ', ' . $request->city . ', ' . $request->state . ', ' . $request->country;

        DB::table('users')->where('id', $user_id)->update([
            'address' => $address
        ]);

        return redirect('/profile')->with('success', 'Cập nhật địa chỉ thành công!');
    }
    public function showUpdateProfile()
    {
        $user_id = Session::get('user_id');
    
        if (!$user_id) {
            return redirect('/')->withErrors(['msg' => 'Bạn chưa đăng nhập!']);
        }
    
        $user = DB::table('users')->where('id', $user_id)->first();
    
        return view('update_profile', compact('user'));
    }
    
    public function updateProfile(Request $request)
    {
        $user_id = Session::get('user_id');
    
        if (!$user_id) {
            return redirect('/')->withErrors(['msg' => 'Bạn chưa đăng nhập!']);
        }
    
        $user = DB::table('users')->where('id', $user_id)->first();
    
        if (!$user) {
            return back()->withErrors(['msg' => 'Không tìm thấy người dùng!']);
        }
    
        $data = [];
    
        // Tên
        if ($request->filled('name')) {
            $data['name'] = $request->name;
        }
    
        // Email
        if ($request->filled('email') && $request->email !== $user->email) {
            if (DB::table('users')->where('email', $request->email)->where('id', '!=', $user_id)->exists()) {
                return back()->withErrors(['email' => 'Email đã được sử dụng']);
            }
            $data['email'] = $request->email;
        }
    
        // Số điện thoại
        if ($request->filled('number') && $request->number !== $user->number) {
            if (DB::table('users')->where('number', $request->number)->where('id', '!=', $user_id)->exists()) {
                return back()->withErrors(['number' => 'Số điện thoại đã được sử dụng']);
            }
            $data['number'] = $request->number;
        }
    
        // Mật khẩu
        if (
            $request->filled('old_pass') ||
            $request->filled('new_pass') ||
            $request->filled('confirm_pass')
        ) {
            if (!Hash::check($request->old_pass, $user->password)) {
                return back()->withErrors(['old_pass' => 'Mật khẩu cũ không đúng']);
            }
    
            if ($request->new_pass !== $request->confirm_pass) {
                return back()->withErrors(['confirm_pass' => 'Mật khẩu xác nhận không khớp']);
            }
    
            if (!empty($request->new_pass)) {
                $data['password'] = Hash::make($request->new_pass);
            } else {
                return back()->withErrors(['new_pass' => 'Vui lòng nhập mật khẩu mới']);
            }
        }
    
        // Cập nhật
        DB::table('users')->where('id', $user_id)->update($data);
    
        return back()->with('success', 'Cập nhật thông tin thành công!');
    }
}
