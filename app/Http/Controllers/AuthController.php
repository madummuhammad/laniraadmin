<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
class AuthController extends Controller
{
    public function login()
    {
        return view('admin.login');
    }

    public function loginProses(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        $user = User::where('username', $username)->first();

        if ($user && $user->password === md5($password)) {
            Auth::login($user);
            return redirect()->intended('/');
        }
        return back()->withErrors(['username' => 'username atau password salah.']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}
