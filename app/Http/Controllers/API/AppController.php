<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\Pdf;
use App\Models\File;
use App\Models\News;
use App\Models\Note;
use App\Models\User;
use App\Models\Blogs;
use App\Models\Ebook;
use App\Models\Coupon;
use App\Models\Course;
use App\Models\Slider;
use App\Models\Feature;
use App\Models\Workshop;
use App\Models\Franchise;
use App\Models\LifeHacks;
use App\Models\CouponUsage;
use App\Models\FileRequest;
use App\Models\BlogCategory;
use App\Models\BusinessTips;
use App\Models\NewsCategory;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\BusinessEvent;
use App\Models\EbookCategory;
use App\Models\CourseCategory;
use App\Models\MembershipPlan;
use App\Models\LifeHacksCategory;
use App\Http\Controllers\Controller;
use App\Models\BusinessTipsCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AppController extends Controller
{
    private $base_URL = 'http://127.0.0.1:8000/';
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['slider']]);
    }
    //Slider API
    public function slider(Request $request)
    {
        // Check if the user is authenticated
        if (auth('api')->check()) {
            // Get the sliders
            $sliders = Slider::all();

            // Return the sliders
            return response()->json([
                'sliders' => $sliders,
            ]);
        }
    }
    //Features API
    public function features(Request $request)
    {

        // Check if the user is authenticated
        if (auth('api')->check()) {
            // Get the sliders
            $features = Feature::all();

            // Return the sliders
            return response()->json([
                'sliders' => $features,
            ]);
        }
    }
    //Franchises API
    public function franchises(Request $request)
    {
        if (auth('api')->check()) {
            $franchises = Franchise::all();

            return response()->json([
                'franchise' => $franchises,
            ]);
        }
    }
    //Workshops API
    public function workshops(Request $request)
    {
        if (auth('api')->check()) {
            $workshops = Workshop::all();
            return response()->json([
                'Workshops' => $workshops,
            ]);
        }
    }
    //Business Event API
    public function businessevent(Request $request)
    {
        if (auth('api')->check()) {
            $BusinessEvents = BusinessEvent::all();
            return response()->json([
                'Business Events' => $BusinessEvents,
            ]);
        }
    }
    //Life Hacks Category API
    public function LifeHacksCategory()
    {
        if (auth('api')->check()) {
            $life_hack_category = LifeHacksCategory::all();
            foreach ($life_hack_category as $category)
                $response[] = [
                    'category_id' => $category->id,
                    'category_name' => $category->life_cat_title,
                    'category_image' => $this->base_URL . 'storage/' . $category->life_cat_img,
                    'category_ispremium' => $category->is_premium,
                    'life_hacks_link' => $this->base_URL . 'api/lifehacks/' . $category->id,
                ];
            return response()->json([
                'life_hack_category' => $response,
                'status' => 200,
                'message' => 'success',
            ]);
        }
    }
    //Life Hacks API
    public function LifeHacks($id)
    {
        if (auth('api')->check()) {
            $life_hacks = LifeHacks::where('life_hacks_cat_id', $id)->get();
            foreach ($life_hacks as $lifehack) {
                $response[] = [
                    'lifehacks_id' => $lifehack->id,
                    'lifehacks_text' => $lifehack->life_hacks_text,
                ];
            }

            return response()->json([
                'Life_Hacks' => $response,
                'status' => 200,
                'message' => 'success',
            ]);
        }
    }
    //Ebook Category API
    public function EbookCategory()
    {

        if (auth('api')->check()) {
            $ebookCategories = EbookCategory::all();
            foreach ($ebookCategories as $ebookcategory)
                $response[] = [
                    'Category_ID' => $ebookcategory->id,
                    'Name' => $ebookcategory->name,
                    'is_premium' => $ebookcategory->is_premium,
                    'Image_URL' => $this->base_URL . 'storage/' . $ebookcategory->image,
                    'Ebook_Link' => $this->base_URL . 'api/ebooks/' . $ebookcategory->id,
                ];
            return response()->json([
                'Ebook_Category' => $response,
                'status' => 200,
                'message' => 'success'
            ]);
        }
    }
    //Ebooks API
    public function Ebooks($id)
    {
        $response = [];
        if (auth('api')->check()) {
            $ebooks = Ebook::where('ebook_category_id', $id)->get();
            foreach ($ebooks as $ebook) {
                $response[] = [
                    'ebook_id' => $ebook->id,
                    'ebook_name' => $ebook->name,
                    'ebook_image' => $ebook->image,
                    'ebook_link' => $this->base_URL . 'storage/' . $ebook->ebook,
                ];
            }

            return response()->json([
                'Life_Hacks' => $response,
                'status' => 200,
                'message' => 'success',
            ]);
        }
    }
    //Business Tips Category API
    public function BusinessTipsCategory()
    {
        if (auth('api')->check()) {
            $businesstipscategories = BusinessTipsCategory::all();

            foreach ($businesstipscategories as $businesstipscategory)
                $response[] = [
                    'Category_ID' => $businesstipscategory->id,
                    'Name' => $businesstipscategory->name,
                    'is_premium' => $businesstipscategory->is_premium,
                    'Image_URL' => $this->base_URL . 'storage/' . $businesstipscategory->image,
                    'Business_Tips_Link' => $this->base_URL . 'api/businesstips/' . $businesstipscategory->id,
                ];


            return response()->json([
                'Business_Tips_Category' => $response,
                'status' => 200,
                'message' => 'success'
            ]);
        }
    }
    //Business Tips API
    public function BusinessTips($id)
    {
        if (auth('api')->check()) {
            $businesstipslist = BusinessTips::where('business_tips_category_id', $id)->get();
            foreach ($businesstipslist as $businesstips)
                $response[] = [
                    'business_tips_category_id' => $businesstips->business_tips_category_id,
                    'title' => $businesstips->title,
                    'description' => $businesstips->description,
                ];
            return response()->json([
                'Business_Tips' => $response,
                'status' => 200,
                'message' => 'success'
            ]);
        }
    }
    //Blog Category API
    public function BlogCategory()
    {
        if (auth('api')->check()) {
            $blogcategories = BlogCategory::all();
            foreach ($blogcategories as $blogcategory)
                $response[] = [
                    'Blog_Category_ID' => $blogcategory->id,
                    'Title' => $blogcategory->name,
                    'Is_Premium' => $blogcategory->is_premium,
                    'Image_URL' => $this->base_URL . 'storage/' . $blogcategory->image,
                    'News_Link' => $this->base_URL . 'api/blogs/' . $blogcategory->id,
                ];
            return response()->json([
                'Blog_Category' => $response,
                'status' => 200,
                'message' => 'success'
            ]);
        }
    }
    //Blog API
    public function Blogs($id)
    {
        if (auth('api')->check()) {
            $category = BlogCategory::find($id);

            if (!$category) {
                return response()->json([
                    'message' => 'Category not found',
                ], 404);
            }

            $blogs = Blogs::where('blog_category_id', $id)->get();
            $response = [];

            foreach ($blogs as $blog) {
                $response[] = [
                    'id' => $blog->id,
                    'title' => $blog->title,
                    'summary' => $blog->summary,
                    'description' => $blog->description,
                    'category_name' => $category->name, // Include the category name
                    'image' => $this->base_URL . 'storage/' . $blog->image,
                ];
            }

            return response()->json([
                'Blogs' => $response,
                'status' => 200,
                'message' => 'success',
            ]);
        }
    }
    //News Category API
    public function NewsCategory()
    {
        if (auth('api')->check()) {
            $newscategories = NewsCategory::all();
            foreach ($newscategories as $newscategory)
                $response[] = [
                    'Name' => $newscategory->name,
                    'Image' => $this->base_URL . 'storage/' . $newscategory->image,
                    'News_Details' => $this->base_URL . 'api/news/' . $newscategory->id,
                ];
            return response()->json([
                'News_Category' => $response,
                'status' => 200,
                'message' => 'success',
            ]);
        }
    }
    //News API
    public function News($id)
    {
        if (auth('api')->check()) {
            $category = NewsCategory::find($id);
            if (!$category) {
                return response()->json([
                    'message' => 'Category not found',
                ], 404);
            }
            $newsList = News::where('news_category_id', $id)->get();
            foreach ($newsList as $news)
                $response[] = [
                    'Id' => $news->id,
                    'Title' => $news->title,
                    'Summary' => $news->summary,
                    'Description' => $news->description,
                    'Image' => $this->base_URL . 'storage/' . $news->image,
                    'News_Category_Name' => $category->name,
                ];
            return response()->json([
                'News' => $response,
                'status' => 200,
                'message' => 'success'
            ]);
        }
    }

    //Notification API
    public function notification()
    {
        if (auth('api')->check()) {
            $notifications = Notification::all();
            foreach ($notifications as $notification)
                $response[] = [
                    'title' => $notification->title,
                    'description' => $notification->description,
                    'image' => $this->base_URL . 'storage/' . $notification->image,
                    'date' => $notification->date,
                    'time' => $notification->time,
                ];
            return response()->json([
                'Notification' => $response,
                'status' => 200,
                'message' => 'success',
            ]);
        }
    }
    //Membership Plan
    public function MembershipPlan()
    {
        if (auth('api')->check()) {
            $membershipplans = MembershipPlan::all();
            foreach ($membershipplans as $membershipplan)
                $response[] = [
                    'title' => $membershipplan->name,
                    'description' => $membershipplan->price,
                    'date' => $membershipplan->new_price,
                ];
            return response()->json([
                'Membership Plan' => $response,
                'status' => 200,
                'message' => 'success',
            ]);
        }
    }
    //Coupon
    public function applyCoupon(Request $request)
    {
        if (auth('api')->check()) {
            //$request->input('coupon_code')
            $couponCode = $request->input('coupon_code');
            $user = auth()->user(); // Assuming you have user authentication

            // Check if the coupon code exists in the database
            $coupon = Coupon::where('code', $couponCode)->first();

            if (!$coupon) {
                return response()->json(['message' => $couponCode], 404);
            }

            // Record the coupon usage
            CouponUsage::create([
                'coupon_id' => $coupon->id,
                'user_id' => $user->id,
            ]);

            // Apply the discount to the user's cart or order
            // Implement your discount logic here

            return response()->json([
                'discount' => $coupon->discount,
                'message' => 'Coupon applied successfully'
            ]);
        }
    }

    //pdf
    public function Pdf($id)
    {
        if (auth('api')->check()) {
            $course = Course::find($id);
            if (!$course) {
                return response()->json([
                    'message' => 'Course not found',
                ], 404);
            }
            $pdfs = $course->Pdf;
            $response = [];
            foreach ($pdfs as $pdf) {
                $response[] = [
                    'id' => $pdf->id,
                    'title' => $pdf->title,
                    'pdf_url' => $this->base_URL . 'storage/' . $pdf->pdf_url,
                ];
            }
            return response()->json([
                'Pdf' => $response,
                'status' => 200,
                'message' => 'success',
            ]);
        }
    }

    //Notes save through API with based on user id and course id
    public function saveNotes(Request $request)
    {
        if (auth('api')->check()) {
            $user = auth()->user();
            $course = Course::find($request->input('course_id'));
            if (!$course) {
                return response()->json([
                    'message' => 'Course not found',
                ], 404);
            }
            $note = Note::create([
                'course_id' => $request->input('course_id'),
                'user_id' => $user->id,
                'note_text' => $request->input('note_text'),
            ]);
            return response()->json([
                'message' => 'Note saved successfully',
            ]);
        }
    }
    //get where route  Route::get('/notes/{user_id}/{course_id}', [AppController::class, 'getNotes']);
    public function getNotes($user_id, $course_id)
    {
        if (auth('api')->check()) {
            $user = User::find($user_id);
            $course = Course::find($course_id);
            if (!$course) {
                return response()->json([
                    'message' => 'Course not found',
                ], 404);
            }
            if (!$user) {
                return response()->json([
                    'message' => 'User not found',
                ], 404);
            }
            $notes = Note::where('user_id', $user_id)->where('course_id', $course_id)->get();
            $response = [];
            foreach ($notes as $note) {
                $response[] = [
                    'id' => $note->id,
                    'note_text' => $note->note_text,
                ];
            }
            return response()->json([
                'Notes' => $response,
                'status' => 200,
                'message' => 'success',
            ]);
        }
    }
    //Note Delete
    public function deleteNotes($id)
    {
        if (auth('api')->check()) {
            $note = Note::find($id);
            if (!$note) {
                return response()->json([
                    'message' => 'Note not found',
                ], 404);
            }
            $note->delete();
            return response()->json([
                'message' => 'Note deleted successfully',
            ]);
        }
    }
    //Note Update
    public function NoteUpdate(Request $request, $id)
    {
        if (auth('api')->check()) {
            $note = Note::find($id);
            if (!$note) {
                return response()->json([
                    'message' => 'Note not found',
                ], 404);
            }
            $note->update([
                'note_text' => $request->input('note_text'),
            ]);
            return response()->json([
                'message' => 'Note updated successfully',
            ]);
        }
    }
    //Course Categories
    public function CourseCategory()
    {
        if (auth('api')->check()) {
            $coursecategories = CourseCategory::all();
            foreach ($coursecategories as $coursecategory)
                $response[] = [
                    'title' => $coursecategory->title,
                    'color_code' => $coursecategory->color_code,
                ];
            return response()->json([
                'Course Category' => $response,
                'status' => 200,
                'message' => 'success',
            ]);
        }
    }
    //Course list
    public function Courses()
    {
        if (auth('api')->check()) {
            $categories = CourseCategory::all();
            $response = [];

            foreach ($categories as $category) {
                $courses = Course::where('course_category_id', $category->id)->get();
                $coursesData = [];

                foreach ($courses as $course) {
                    $coursesData[] = [
                        'id' => $course->id,
                        'title' => $course->title,
                        'image' => $this->base_URL . 'storage/' . $course->image,
                        'description' => $course->description,
                        'duration' => $course->duration,
                        'status' => $course->status,
                        'instructor_name' => $course->User->name,
                        'course_category_name' => $course->CourseCategory->title,
                        'lesson_link' => $this->base_URL . 'api/lesson/' . $course->id,
                    ];
                }

                $response[] = [
                    'category_id' => $category->id,
                    'category_name' => $category->title,
                    'courses' => $coursesData,
                ];
            }

            return response()->json([
                'Categories' =>  $response,
                'status' => 200,
                'message' => 'success',
            ]);
        }
    }

    //Lesson list
    public function Lesson($id)
    {
        if (auth('api')->check()) {
            $course = Course::find($id);
            if (!$course) {
                return response()->json([
                    'message' => 'Course not found',
                ], 404);
            }

            $lessons = $course->Lesson;

            $response = [];

            foreach ($lessons as $lesson) {
                $response[] = [
                    'id' => $lesson->id,
                    'title' => $lesson->title,
                    'description' => $lesson->description,
                    'position' => $lesson->position,
                    'video' => $lesson->video_link,
                    'is_premium' => $lesson->is_premium,
                    'image' => $this->base_URL . 'storage/' . $lesson->image,
                ];
            }

            return response()->json([
                'Lessons' => $response,
                'status' => 200,
                'message' => 'success',
            ]);
        }
    }
    //User Request for file
    public function listFiles()
    {
        if (auth('api')->check()) {
            $files = File::all();
            return response()->json([
                'files' => $files,
                'status' => 200,
                'message' => 'success',
            ]);
        }
    }

    public function submitFileRequest(Request $request)
    {
        if (auth('api')->check()) {
            // Validate the request
            $validator = Validator::make($request->all(), [
                'file_id' => 'required|exists:files,id',
            ]);

            if ($validator->fails()) {
                return response()->json(['message' => $validator->errors()->first()], 400);
            }

            // Find the file by ID
            $file = File::find($request->input('file_id'));

            if (!$file) {
                return response()->json(['message' => 'File not found'], 404);
            }

            // Check if the user has already requested this file
            $fileRequest = FileRequest::where('file_id', $file->id)
                ->where('user_id', auth()->user()->id)
                ->first();

            if ($fileRequest) {
                return response()->json(['message' => 'You have already requested this file'], 400);
            }

            // Create a new file request
            $fileRequest = FileRequest::create([
                'user_id' => auth()->user()->id,
                'file_id' => $file->id,
            ]);

            return response()->json(['message' => 'File request submitted successfully']);
        }
    }


    public function getUserFileRequests($userId)
    {
        if (auth('api')->check()) {
            // Find the user by ID
            $user = User::find($userId);

            if (!$user) {
                return response()->json(['message' => 'User not found'], 404);
            }

            // Get the user's file requests
            $fileRequests = FileRequest::where('user_id', $user->id)->get();

            return response()->json(['file_requests' => $fileRequests, 'status' => 200]);
        }
    }
    public function generateDownloadLink($fileId, $userId)
    {
        if (auth('api')->check()) {
              // Find the user by ID
        $user = User::find($userId);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Find the file request by file ID and user ID
        $fileRequest = FileRequest::where('file_id', $fileId)
            ->where('user_id', $userId)
            ->first();

        if (!$fileRequest) {
            return response()->json(['message' => 'File request not found'], 404);
        }

        // Find the requested file by file ID
        $file = File::find($fileId);

        if (!$file) {
            return response()->json(['message' => 'File not found'], 404);
        }

        // Generate the download link (you may need to adjust this based on your file storage configuration)
        $downloadLink = url('storage/' . $file->path);

        return response()->json(['download_link' => $downloadLink, 'status' => 200]);
        }
    }
}
