<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function getLogin(Request $request) {
        return view('login');
    }

    public function postLogin(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:3'
        ]);

        if ($validator->fails()) return back()->withErrors($validator->errors())->withInput();
        $validate = $validator->validate();

        $getUsers = User::where('email', $validate['email'])->get()->first();
        if (!$getUsers || !Hash::check($validate['password'], $getUsers->password)) return redirect()->route('login')->with('error', 'Akun tidak terdaftar atau Password Salah!');

        Auth::login($getUsers);
        $request->session()->regenerate();

        return redirect()->route('certificates')->with('success', 'Login Berhasil!');
    }

    public function logout(Request $request) {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('index')->with('success', 'Logout Berhasil!');
    }
}
