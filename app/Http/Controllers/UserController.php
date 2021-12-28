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
            'admin' => false,
            'pic' => $request->pic,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
    }
    public function update(Request $request)
    {
        $user = User::find($request->id);
        if($user->phone !== $request -> phone && $user->email !== $request -> email){
            $request->validate([
                'phone' => ['required', 'min:10', 'unique:users'],
                'email' => ['required', 'email', 'unique:users']
            ]);
        }else if($user->phone !== $request -> phone && $user->email == $request -> email){
            $request->validate([
                'phone' => ['required', 'min:10', 'unique:users'],
            ]);
        }else if($user->phone == $request -> phone && $user->email !== $request -> email){
            $request->validate([
                'email' => ['required', 'email', 'unique:users']
            ]);
        }
        if($request->oldpassword != ""){
            if(!Hash::check($request->oldpassword,$user->password)){
                return "舊密碼錯誤";
            }
            $request->validate([
                'password' =>['required', 'min:6', 'confirmed']
            ]);
            if($user){
                $user->name = $request -> name;
                $user->phone = $request -> phone;
                $user->pic = $request -> pic;
                $user->email = $request -> email;
                $user->password = Hash::make($request->password);
                
                $user->save();
                return $user;
            }
        }else{
            if($user){
                $user->name = $request -> name;
                $user->phone = $request -> phone;
                $user->pic = $request -> pic;
                $user->email = $request -> email;
                $user->save();
                return $user;
            }
        }
        return "找無此用戶";
    }
}
