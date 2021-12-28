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
    public function updateCourse(Request $request){
        $course = Course::find($request->id);
        $content = $request->validate([
            'title' =>'required',
            'pic1' =>'required',
            'class1' =>'required',
        ]);

        $course->title = $request->title;
        $course->content = $request->content;
        $course->pic1 = $request->pic1;
        $course->pic2 = $request->pic2;
        $course->pic3 = $request->pic3;
        $course->price = $request->price;
        $course->notice = $request->notice;
        $course->place = $request->place;
        $course->course_start_time = $request->course_start_time;
        $course->course_send_time = $request->course_send_time;
        $course->signUp_start_time = $request->signUp_start_time;
        $course->signUp_end_time = $request->signUp_end_time;
        $course->class1 = $request->class1;
        $course->class2 = $request->class2;
        $course->class3 = $request->class3;

        $course->save();
        return "課程更新成功";
    }
}
