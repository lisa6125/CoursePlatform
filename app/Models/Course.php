<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'usernum',
        'content',
        'pic1',
        'pic2',
        'pic3',
        'price',
        'notice',
        'place',
        'course_start_time',
        'course_send_time',
        'signUp_start_time',
        'signUp_end_time',
        'place',
        'class1',
        'class2',
        'class3'
    ];
    public function UserJoinCourse(){
        return $this->belongsToMany('App\Models\User');
    }
}