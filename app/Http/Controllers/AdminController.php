<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
class AdminController extends Controller
{
    public function cheackadmin($id){
        $user = User::find($id);
        if($user->admin !== 1){
            return false;
        }
        return true;
    }
    public function createCourese(Request $request)
    {
        Course::create([
            'title' => $request->title,
            'content' => $request->content,
            'pic1' => $request->pic1,
            'pic2' => $request->pic2,
            'pic3' => $request->pic3,
            'price' => $request->price,
            'place' => $request->place,
            'course_start_time' => $request->course_start_time,
            'course_send_time' => $request->course_send_time,
            'signUp_start_time' => $request->signUp_start_time,
            'signUp_end_time' => $request->signUp_end_time,
            'class1' => $request->class1,
            'class2' => $request->class2,
            'class3' => $request->class3,
            'usernum' => 0,
        ]);
        return "新增成功";
    }
    public function getCourese(){
        return Course::orderBy('created_at')->get();
    }
}
