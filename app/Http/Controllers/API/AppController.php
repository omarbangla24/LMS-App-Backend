<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\Ebook;
use App\Models\Slider;
use App\Models\Feature;
use App\Models\Workshop;
use App\Models\Franchise;
use App\Models\LifeHacks;
use App\Models\BusinessTips;
use Illuminate\Http\Request;
use App\Models\BusinessEvent;
use App\Models\EbookCategory;
use App\Models\LifeHacksCategory;
use App\Http\Controllers\Controller;
use App\Models\BusinessTipsCategory;
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
    public function BusinessTipsCategory(){
        if(auth('api')->check()){
            $businesstipscategories = BusinessTipsCategory::all();

            foreach($businesstipscategories as $businesstipscategory)
            $response[] = [
                'Category_ID' => $businesstipscategory->id,
                'Name' => $businesstipscategory->name,
                'is_premium' => $businesstipscategory->is_premium,
                'Business_Tips_Link' => $this-> base_URL . 'api/businesstips/' . $businesstipscategory->id,
            ];


            return response()->json([
                'Business_Tips_Category' => $response,
                'status' => 200,
                'message' => 'success'
            ]);
        }
    }
     //Business Tips API
    public function BusinessTips($id){
            if(auth('api')->check()){
                $businesstipslist = BusinessTips::where('business_tips_category_id', $id)->get();
                foreach( $businesstipslist as $businesstips)
                $response [] =[
                    'business_tips_category_id' => $businesstips->business_tips_category_id,
                    'title' => $businesstips->title,
                    'description' => $businesstips->description,
                ];
                return response()->json([
                    'Business_Tips' => $response,
                    'status'=> 200,
                    'message' => 'success'
                ]);
            }
    }
}
