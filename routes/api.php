<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::middleware('auth:sanctum')->get('/athenticated', function () {
    return true;
});
Route::prefix('user')->group(function(){
    Route::post('/login', [UserController::class,'login']);
    Route::post('/register', [UserController::class,'register']);
    Route::post('/logout', [UserController::class,'logout']);
    Route::post('/update', [UserController::class,'update']);
    Route::get('/getcourse', [UserController::class,'getcourse']);
    Route::get('/getgroup', [UserController::class,'getgroup']);
});

Route::prefix('admin')->group(function(){
    Route::post('/checkadmin/{id}', [AdminController::class,'checkadmin']);
    Route::post('/createCourese', [AdminController::class,'createCourese']);
    Route::post('/createGroup', [AdminController::class,'createGroup']);
    
    Route::get('/getCourese', [AdminController::class,'getCourese']);
    Route::get('/getGroup/{id}', [AdminController::class,'getGroup']);
    Route::get('/getOtherUserGroup/{id}', [AdminController::class,'getOtherUserGroup']);
    Route::get('/getUser', [AdminController::class,'getUser']);

    Route::post('/updateCourse', [AdminController::class,'updateCourse']);
    Route::post('/updateGroup', [AdminController::class,'updateGroup']);
    Route::post('/destroyCourse/{id}', [AdminController::class,'destroyCourse']);
    Route::post('/destroyGroup/{id}', [AdminController::class,'destroyGroup']);
    Route::delete('/destroyUser/{id}', [AdminController::class,'destroyUser']);

});