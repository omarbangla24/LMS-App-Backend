<?php

use App\Models\News;
use App\Models\Blogs;
use App\Models\BlogCategory;
use App\Models\BusinessTips;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use App\Models\BusinessTipsCategory;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AppController;
use App\Http\Controllers\API\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['middleware'=>'api'],function($routes){
    Route::post('/register',[UserController::class,'register']);
    Route::post('/login',[UserController::class, 'login']);
    Route::get('/logout',[UserController::class, 'logout']);
    Route::get('/profile',[UserController::class, 'profile']);
    Route::post('/profileupdate',[UserController::class, 'profileupdate']);
    Route::get('/refreshtoken',[UserController::class, 'refreshToken']);
    Route::post('forgetpassword', [UserController::class, 'forgetPassword']);
    Route::post('checkotp', [UserController::class, 'checkOTP']);
    Route::post('change_password_by_otp', [UserController::class, 'change_password_by_otp']);
});
Route::middleware('auth:api')->group(function () {
    Route::get('/slider', [AppController::class, 'slider']);
    Route::get('/features', [AppController::class, 'features']);
    Route::get('/franchises', [AppController::class, 'franchises']);
    Route::get('/workshops', [AppController::class, 'workshops']);
    Route::get('/businessevents', [AppController::class, 'businessevent']);
    Route::get('/lifehackscategory', [AppController::class, 'LifeHacksCategory']);
    Route::get('/lifehacks/{id}', [AppController::class, 'LifeHacks']);
    Route::get('/ebookcategory', [AppController::class, 'EbookCategory']);
    Route::get('/ebooks/{id}', [AppController::class, 'Ebooks']);
    Route::get('/businesstipscategory', [AppController::class, 'BusinessTipsCategory']);
    Route::get('/businesstips/{id}', [AppController::class, 'BusinessTips']);
    Route::get('/blogcategory', [AppController::class, 'BlogCategory']);
    Route::get('/blogs/{id}', [AppController::class, 'Blogs']);
    Route::get('/newscategory', [AppController::class, 'NewsCategory']);
    Route::get('/news/{id}', [AppController::class, 'News']);

});
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
