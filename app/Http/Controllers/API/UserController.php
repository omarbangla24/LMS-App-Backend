<?php

namespace App\Http\Controllers\API;


use App\Mail\GreetingsMail;
use App\Mail\RegisterReport;
use App\Mail\ResetPassword;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;


class UserController extends Controller
{
    //Register API
    public function register(Request $request)
    {
        // Validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:2|max:100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6',
        ]);

        // Check for validation errors
        if ($validator->fails()) {
            throw ValidationException::withMessages($validator->errors()->all());
        }

        // Create a new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Return a success response
        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user,
        ], 201); // 201 Created status code
    }

    //Login API
    public function login(Request $request)
    {
        // Validation rules
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string|min:6',
        ]);

        // Check for validation errors
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        // Attempt to authenticate the user
        if (!$token = auth()->attempt($validator->validated())) {
            return response()->json(['success' => false, 'msg' => 'Username or Password incorrect']);
        }

        // Generate a response with the access token
        return $this->respondWithToken($token);
    }
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
        ]);
    }

    //Logout API
    public function logout()
    {
        try {
            auth()->logout();
            return response()->json(['success' => true, 'message' => 'User Logout!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    //Profile Data Get
    public function profile()
    {
        try {
            return response()->json(['success' => true, 'data' => auth()->user()]);
        } catch (\Exception $e) {
            return response()->josn(['success' => false, 'message' => $e->getMessage()]);
        }
    }
    //Profile Data Update
    public function profileupdate(Request $request)
    {
        if (auth()->user()) {
            $validator = Validator::make($request->all(), [
                'id' => 'required',
                'name' => 'required|string',
                'email' => 'required|email|string'
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors());
            }
            $user = User::find($request->id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->mobile_no = $request->mobile_no;
            $user->address = $request->address;
            $user->age = $request->age;
            $user->profile_image_path = $request->profile_image_path;
            $user->save();
            return response()->json(['success' => true, 'message' => 'Updated', 'data' => $user]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User Unauthorized'
            ]);
        }
    }
    //Refresh Token
    public function refreshToken()
    {
        if(auth()->user()){
            return $this->respondWithToken(Auth()->refresh());
        }else{
            return response()->json(['success'=>false, 'message'=>'User is not authorized']);
        }
    }
    //Forget Password
    function forgetPassword(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required|email',
            ],
            ['email.email' => 'Please Enter a Valid Email']
        );
        //    $request->validate([
        //         'email' => 'required|email',
        //     ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 406,
                'error' => $validator->errors(),
            ], 406);
        } else {
            $userOTP = User::where('email', $request->email)->first();

            if ($userOTP == '') {
                return response()->json([
                    'error' => [
                        'status' => 401,
                        'message' => 'We have no Record of this Email',
                    ]
                ], 401);
            } else {
                $generate_otp = random_int(100000, 999999);
                $update_otp = User::where('email', $request->email)->update([
                    'otp' => $generate_otp,
                ]);

                $resetPassword = [
                    'user' => $userOTP->name,
                    'otp' => $generate_otp,
                ];


                Mail::to($userOTP->email)->send(new ResetPassword($resetPassword));

                return response()->json([
                    'status' => 200,
                    'message' => 'OTP send Successful',
                    'email' => $userOTP->email
                ], 200);
            }
        }
    }
    function checkOTP(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp_code' => 'required|integer'
        ]);

        $check_OTP = User::where('email', $request->email)->select('otp')->first();
        if ($check_OTP->otp == $request->otp_code) {
            return response()->json([
                'status' => 200,
                'message' => 'OTP Matched'
            ]);
        } else {
            return response()->json([
                'error' => [
                    'status' => 401,
                    'message' => 'OTP Did not Matched',
                ],
            ], 401);
        }
    }
    function change_password_by_otp(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'new_password' => 'required',
            'confirm_password' => 'required|same:new_password'
        ], [
            'confirm_password.same' => 'Password Did Not Match'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 401,
                'error' => $validator->errors()
            ], 401);
        } else {
            $user = User::where('email', $request->email)->update([
                'password' => Hash::make($request->new_password),
            ]);
            if ($user) {
                return response()->json([
                    'status' => 200,
                    'message' => "Password Changed Successfully"
                ], 200);
            } else {
                return response()->json([
                    'status' => 400,
                    'message' => "Password can't Change"
                ], 400);
            }
        }
    }
}
