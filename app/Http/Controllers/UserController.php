<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'account' => ['required'],
            'password' => ['required']
        ]);

        if (Auth::attempt($request->only('account', 'password'))){
            return response()->json(Auth::user(), 200);
        }
        throw ValidationException::withMessages([
            'account' =>['帳號密碼錯誤']
        ]);
    }
    public function logout()
    {
        Auth::logout();
    }
    public function register(Request $request)
    {

        $request->validate([
            'name' => ['required'],
            'account' => ['required', 'min:4', 'unique:users'],
            'phone' => ['required', 'min:10', 'unique:users'],
            'email' => ['required', 'email', 'unique:users'],
            'password' =>['required', 'min:6', 'confirmed']
        ]);

        User::create([
            'name' => $request->name,
            'account' => $request->account,
            'phone' => $request->phone,
            'admin' => $request->admin,
            'pic' => $request->pic,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
    }
}
