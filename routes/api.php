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
use App\Http\Controllers\CheckoutURLController;

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

Route::group(['middleware' => 'api'], function ($routes) {
    Route::post('/register', [UserController::class, 'register']);
    Route::post('/login', [UserController::class, 'login']);
    Route::get('/logout', [UserController::class, 'logout']);
    Route::get('/profile', [UserController::class, 'profile']);
    Route::post('/profileupdate', [UserController::class, 'profileupdate']);
    Route::get('/refreshtoken', [UserController::class, 'refreshToken']);
    Route::post('/forgetpassword', [UserController::class, 'forgetPassword']);
    Route::post('/checkotp', [UserController::class, 'checkOTP']);
    Route::post('/change_password_by_otp', [UserController::class, 'change_password_by_otp']);
    //route for update status, amount, trans_date, trans_id, bkash_mobile, expire_date
    Route::post('/update_payment_info', [UserController::class, 'update_payment_info']);
});
// Bkash Api Start
// Checkout (URL) User Part
Route::post('/bkash/create', [CheckoutURLController::class, 'create'])->name('url-create');
Route::get('/bkash/callback', [CheckoutURLController::class, 'callback'])->name('url-callback');

// Checkout (URL) Admin Part
// Route::post('/bkash/refund', [CheckoutURLController::class, 'refund'])->name('url-post-refund');

// Bkash Api End
Route::middleware('auth:api')->group(function () {
    //App Design
    Route::get('/slider', [AppController::class, 'slider']);
    Route::get('/features', [AppController::class, 'features']);
    Route::get('/notification', [AppController::class, 'Notification']);
    //App Features
    Route::get('/franchises', [AppController::class, 'franchises']);
    Route::get('/workshops', [AppController::class, 'workshops']);
    Route::get('/businessevents', [AppController::class, 'businessevent']);
    //Extra
    Route::get('/lifehackscategory', [AppController::class, 'LifeHacksCategory']);
    Route::get('/lifehacks/{id}', [AppController::class, 'LifeHacks']);
    Route::get('/ebookcategory', [AppController::class, 'EbookCategory']);
    Route::get('/ebooks/{id}', [AppController::class, 'Ebooks']);
    Route::get('/businesstipscategory', [AppController::class, 'BusinessTipsCategory']);
    Route::get('/businesstips/{id}', [AppController::class, 'BusinessTips']);
    //Blog & News
    Route::get('/blogcategory', [AppController::class, 'BlogCategory']);
    Route::get('/blogs/{id}', [AppController::class, 'Blogs']);
    Route::get('/newscategory', [AppController::class, 'NewsCategory']);
    Route::get('/news/{id}', [AppController::class, 'News']);
    //Course
    Route::get('/coursecategory', [AppController::class, 'CourseCategory']);
    Route::get('/courses', [AppController::class, 'Courses']);
    Route::get('/lesson/{id}', [AppController::class, 'Lesson']);
    //PDF
    Route::get('/pdf/{id}', [AppController::class, 'Pdf']);
    //Notes
    Route::post('/notes/save', [AppController::class, 'saveNotes']);
    Route::get('/notes/{user_id}/{course_id}', [AppController::class, 'getNotes']);
    Route::delete('/notes/delete/{id}', [AppController::class, 'deleteNotes']);
    Route::post('/notes/update/{id}', [AppController::class, 'NoteUpdate']);
    //Payment
    Route::get('/membershipplan', [AppController::class, 'MembershipPlan']);
    Route::get('/coupon', [AppController::class, 'applyCoupon']);
    // List Available Files
    Route::get('/files', [AppController::class, 'listFiles']);

    // Submit File Request Route
    Route::post('/file-requests', [AppController::class, 'submitFileRequest']);

    // Get User's File Requests
    Route::get('/file-requests/user/{userId}', [AppController::class, 'getUserFileRequests']);

    // Generate Download Link for Requested Files
    Route::get('/download/{fileId}/user/{userId}', [AppController::class, 'generateDownloadLink']);
    //idea
    Route::get('/idea', [AppController::class, 'getIdea']);
    //like dislike



});
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
