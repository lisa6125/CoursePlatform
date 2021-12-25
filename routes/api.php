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
});

Route::prefix('admin')->group(function(){
    Route::post('/cheackadmin/{id}', [AdminController::class,'cheackadmin']);
    Route::post('/createCourese/{id}', [AdminController::class,'createCourese']);
});