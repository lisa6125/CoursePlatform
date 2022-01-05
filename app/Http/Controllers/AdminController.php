<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Course;
use App\Models\Activity;
class AdminController extends Controller
{
    public function checkadmin($id){
        $user = User::find($id);
        if($user->admin !== 1){
            return false;
        }
        return true;
    }
    public function createCourese(Request $request)
    {
        $who = User::find($request-> who);
        $courseyouopen = $who->courseyouopen;
        $who->courseyouopen = $courseyouopen+1;
        $who->save();
        Course::create([
            'title' => $request->title,
            'content' => $request->content,
            'notice' => $request->notice,
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
    public function createGroup(Request $request)
    {
        $who = User::find($request-> who);
        $activityyouopen = $who->activityyouopen;
        $who->activityyouopen = $activityyouopen+1;
        $who->save();
        Activity::create([
            'title' => $request->title,
            'who_create' => $request->who_create,
            'content' => $request->content,
            'pic1' => $request->pic1,
            'pic2' => $request->pic2,
            'pic3' => $request->pic3,
            'price' => $request->price,
            'notice' => $request->notice,
            'place' => $request->place,
            'activity_start_time' => $request->activity_start_time,
            'activity_send_time' => $request->activity_send_time,
            'signUp_start_time' => $request->signUp_start_time,
            'signUp_end_time' => $request->signUp_end_time,
            'connect_user_phone' => $request->connect_user_phone,
            'connect_user_email' => $request->connect_user_email,
            'connect_user_pic' => $request->connect_user_pic,
            'condition' => $request->condition,
            'state' => '召集中',
            'class1' => $request->class1,
            'class2' => $request->class2,
            'class3' => $request->class3,
            'usernum' => 0,
        ]);
        return "新增開團成功";
    }
    public function getCourese(){
        return Course::orderBy('created_at')->get();
    }
    public function getGroup($id){
        return Activity::where('who_create',$id)->get();
    }
    public function getOtherUserGroup($id){
        $collection = Activity::all();
        $groupitem = $collection->filter(function($item) use($id){
            return $item->who_create != $id;
        });
        return $groupitem;
    }
    public function getUser(){
        return User::orderBy('created_at')->get();
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
    public function updateGroup(Request $request){
        $activity = Activity::find($request->id);
        $activity->title = $request->title;
        $activity->content = $request->content;
        $activity->pic1 = $request->pic1;
        $activity->pic2 = $request->pic2;
        $activity->pic3 = $request->pic3;
        $activity->price = $request->price;
        $activity->notice = $request->notice;
        $activity->place = $request->place;
        $activity->activity_start_time = $request->activity_start_time;
        $activity->activity_send_time = $request->activity_send_time;
        $activity->signUp_start_time = $request->signUp_start_time;
        $activity->signUp_end_time = $request->signUp_end_time;
        $activity->condition = $request->condition;
        $activity->class1 = $request->class1;
        $activity->class2 = $request->class2;
        $activity->class3 = $request->class3;
        $activity->state = $request->state;


        $activity->save();
        return "課程更新成功";
    }
    public function destroyCourse(Request $request,$id){
        $course =  Course::find($id);
        $user = User::find($request->id);
        $courseyouopen = $user->courseyouopen;
        $user->courseyouopen = $courseyouopen -1;
        $user->save();
        if($course){
            $course->delete();
            return "課程刪除成功";
        }
            return "課程刪除失敗";
    }
    public function destroyGroup(Request $request,$id){
        $activity = Activity::find($id);
        $user = User::find($request->id);
        $activityyouopen = $user->activityyouopen;
        $user->activityyouopen = $activityyouopen -1;
        $user->save();
        if($activity){
            $activity->delete();
            return "活動刪除成功";
        }
            return "活動刪除失敗";
    }
    public function destroyUser($id){
        $user = User::find($id);
        if($user){
            $user->delete();
            return "用戶刪除成功";
        }
            return "用戶刪除失敗";
    }
}