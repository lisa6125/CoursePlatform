<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'who_create',
        'content',
        'pic1',
        'pic2',
        'pic3',
        'price',
        'notice',
        'place',
        'activity_start_time',
        'activity_send_time',
        'signUp_start_time',
        'signUp_end_time',
        'place',
        'connect_user_phone',
        'connect_user_email',
        'connect_user_pic',
        'condition',
        'state',
        'class1',
        'class2',
        'class3'
    ];
}
