<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class AdminController extends Controller
{
    public function cheackadmin($id){
        $user = User::find($id);
        if($user->admin !== 1){
            return false;
        }
        return true;
    }
    public function createCourese($id)
    {
        $user = User::find($id);
        if($user->admin !== 1){
            return "無管理權";
        }
        return "新增成功";
    }
}
