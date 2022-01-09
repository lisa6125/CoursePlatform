<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use App\Models\Course;
use App\Models\Activity;

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
            'password' => Hash::make($request->password),
            'courseyoujoin'=>$request->courseyoujoin,
            'courseyouopen'=>$request->courseyouopen,
            'activityyoujoin'=>$request->activityyoujoin,
            'activityyouopen'=>$request->activityyouopen,
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
    public function getcourse()
    {
        return Course::offset(0)->select('title', 'pic1')->limit(6)->get();
    }
    public function getgroup()
    {
        return Activity::offset(0)->select( 'pic1')->limit(6)->get();
    }
    // Course
    public function takeParticipateCourse(Request $request,$id){
        // 課程人數
        $existingItem = Course::find($id);
        $usernum = $existingItem->usernum;
        $existingItem->usernum = $usernum +1 ;
        $existingItem->save();

        $user = User::find($request->userId);
        $courseyoujoin = $user -> courseyoujoin;
        $user -> courseyoujoin = $courseyoujoin +1 ;
        $user ->save();

        $existingItem->UserJoinCourse()->save($user);
        return "參加成功!";
    }
    public function getUserParticipate(Request $request){
        $user = User::find($request->userId);
        $getUserParticipate = $user->ParticipateCourse;
        return $getUserParticipate;
    }
    public function UserCancelParticipate(Request $request,$id){
        // 課程人數
        $existingItem = Course::find($id);
        $usernum = $existingItem->usernum;
        $existingItem->usernum = $usernum - 1 ;
        $existingItem->save();

        $user = User::find($request->userId);
        $courseyoujoin = $user -> courseyoujoin;
        $user -> courseyoujoin = $courseyoujoin - 1 ;
        $user ->save();
        $user->ParticipateCourse()->detach($id);
        return "已取消參加此活動";
    }
    // activity
    public function takeParticipateActivity(Request $request,$id){
        // 課程人數
        $existingItem = Activity::find($id);
        $usernum = $existingItem->usernum;
        $existingItem->usernum = $usernum +1 ;
        $existingItem->save();

        $user = User::find($request->userId);
        $activityyoujoin = $user -> activityyoujoin;
        $user -> activityyoujoin = $activityyoujoin +1 ;
        $user ->save();

        $existingItem->UserJoinActivity()->save($user);
        return "參加成功!";
    }
    public function getUserParticipateActivity(Request $request){
        $user = User::find($request->userId);
        $getUserParticipate = $user->ParticipateActivity;
        $newUserParticipate = $getUserParticipate->each(function ($item) {
            $who = User::find($item->who_create);
            $item->user_name = $who -> name;
            $item->user_pic = $who -> pic;
            $item->user_phone = $who -> phone;
            $item->user_email = $who -> email;
        });
        return $newUserParticipate;
    }
    public function UserCancelParticipateActivity(Request $request,$id){
        // 課程人數
        $existingItem = Activity::find($id);
        $usernum = $existingItem->usernum;
        $existingItem->usernum = $usernum - 1 ;
        $existingItem->save();

        $user = User::find($request->userId);
        $activityyoujoin = $user -> activityyoujoin;
        $user -> activityyoujoin = $activityyoujoin - 1 ;
        $user ->save();
        $user->ParticipateActivity()->detach($id);
        return "已取消參加此活動";
    }
}