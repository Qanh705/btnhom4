<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class QuenMatKhauController extends Controller
{
    public function formquenmatkhau()
    {
        return view('quenmatkhau');
    }

    public function quenmatkhau(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:50',
            'new_pass' => 'required|string|max:50',
        ]);

        $email = htmlspecialchars($request->email, ENT_QUOTES, 'UTF-8');
        $new_pass = htmlspecialchars($request->new_pass, ENT_QUOTES, 'UTF-8');
        $hashed = sha1($new_pass); 

        try {
            $updated = DB::update(
                "UPDATE users SET password = ? WHERE email = ?",
                [$hashed, $email]
            );

            if ($updated) {
                return back()->with('message', 'mật khẩu được cập nhật thành công!');
            } else {
                return back()->with('message', 'Đã xảy ra lỗi khi cập nhật mật khẩu.');
            }
        } catch (\Exception $e) {
            return back()->with('message', 'Lỗi hệ thống: ' . $e->getMessage());
        }
    }
}
