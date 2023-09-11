<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\Slider;
use App\Models\Feature;
use App\Models\Workshop;
use App\Models\Franchise;
use App\Models\LifeHacks;
use Illuminate\Http\Request;
use App\Models\BusinessEvent;
use App\Models\LifeHacksCategory;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AppController extends Controller
{
    private $base_URL = 'http://127.0.0.1:8000/';
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['slider']]);
    }

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
    public function franchises(Request $request){
        if(auth('api')->check()){
            $franchises = Franchise::all();

            return response()->json([
                'franchise'=>$franchises,
            ]);
        }
    }
    public function workshops(Request $request){
        if(auth('api')->check()){
            $workshops = Workshop::all();
            return response()->json([
                'Workshops'=>$workshops,
            ]);
        }
    }
    public function businessevent(Request $request){
        if(auth('api')->check()){
            $BusinessEvents = BusinessEvent::all();
            return response()->json([
                'Business Events'=>$BusinessEvents,
            ]);
        }
    }
    public function LifeHacksCategory(){
        if(auth('api')->check()){
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
}
