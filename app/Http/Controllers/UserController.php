<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function formlogin()
    {
        return view('login');
    }
    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = sha1($request->input('pass'));

        $user = DB::table('users')
                    ->where('email', $email)
                    ->where('password', $password)
                    ->first();

        if ($user) {
            session(['user_id' => $user->id]);
            session(['user_name' => $user->name]);
            return redirect('/');
        } else {
            return back()->with('error', 'Mật khẩu không đúng! Vui lòng nhập lại')->withInput();
        }
    }
    public function logout()
    {
        Session::flush();
        return redirect('/');
    }
}
