<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    public function login()
    {
        $validator = Validator::make([
            "email" => $this->request->email,
            "password" => $this->request->password,
        ], [
            "email" => ['required', 'email', 'exists:users,email'],
            "password" => ["required"],
            // "confirmed"
        ], [
            "email.required" => __("This field is required"),
            "email.email" => __("Enter a valid email please"),
            "password.required" => __("This field is required"),
            // "password.confirmed" => __("Password does not match"),
            "email.exists" => __("Email is incorrect"),
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'status' => false,
                'code' => 422,
                'message' => __('login error'),
                'errors' => $errors,
            ], 422);
        }

        if ($validator->passes()) {
            $data = $validator->validated();

            $user = User::data()->where('email', $data['email'])->first();
            $user->is_verify = $user->is_verify;

            if ($user && Hash::check($data['password'], $user->password)) {
                // generate token and save it in database
                $token = $user->createToken("Device Name", ['*']);
                return response()->json([
                    'status' => true,
                    'code' => 200,
                    'message' => __('Logged in successfully'),
                    'data' => [
                        "token" => $token->plainTextToken,
                        "user" => $user
                    ],
                ], 200);
            }
        }

        return response()->json([
            'status' => false,
            'code' => 422,
            'message' => __("Please check the data entered"),
            'errors' => [],
        ], 422);
    }
    public function register()
    {
        $validator = Validator::make([
            "email" => $this->request->email,
            "password" => $this->request->password,
            "password_confirmation" => $this->request->password_confirmation,
            "type" => $this->request->type,
            // "status" => $this->request->status,
        ], [
            "email" => ['required', 'email', 'unique:users,email'],
            "password" => ["required", "confirmed"],
            "type" => ['required', 'in:seller,buyer'],
            // "status" => ['required', 'in:active,inactive'],
        ], [
            "email.required" => __("This field is required"),
            "email.email" => __("Enter a valid email please"),
            "password.required" => __("This field is required"),
            "password.confirmed" => __("Password does not match"),
            "email.unique" => __("Email is already used"),
            // "type.required" => __(""),
            // "status.required" => __(""),
            // "status.in" => __(""),
            // "status.in" => __(""),
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'status' => false,
                'code' => 422,
                'message' => __('register error'),
                'errors' => $errors,
            ], 422);
        }

        if ($validator->passes()) {
            $data = $validator->validated();

            $code = random_int(1111, 9999);

            $user = User::create([
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'type' => $data['type'], // 'haraj', 'buyer'
                'status' => "inactive",
                "code" => $code
            ]);

            $user = User::data()->find($user->id);
            $user->is_verify = $user->is_verify;

            // $token = $user->createToken("Device Name", ['*']);

            return response()->json([
                'status' => true,
                'code' => 200,
                'message' => __('Your account has been successfully registered'),
                'data' => [
                    "token" => null,
                    "user" => $user
                ],
            ], 200);
        }
    }
    public function otp()
    {
        dd("otp");
    }
    public function verify()
    {
        $validator = Validator::make([
            "email" => $this->request->email,
            "code" => $this->request->code,
        ], [
            "email" => ['required', 'email', 'exists:users,email'],
            "code" => ['required'],
        ], [
            "email.required" => __("This field is required"),
            "email.email" => __("Enter a valid email please"),
            "email.exists" => __("Email is incorrect"),
            "code" => __("This field is required")
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'status' => false,
                'code' => 422,
                'message' => __('verify error'),
                'errors' => $errors,
            ], 422);
        }

        if ($validator->passes()) {
            $data = $validator->validated();

            $user = User::where('email', $data['email'])->first();

            if ($user->code == $data['code']) {
                $user->update([
                    "code" => null,
                    "status" => "active",
                    "email_verified_at" => now()
                ]);

                $user = User::data()->where('email', $data['email'])->first();
                $user->is_verify = $user->is_verify;

                return response()->json([
                    'status' => true,
                    'code' => 200,
                    'message' => __('Email Verified Successfully'),
                    'data' => [
                        "user" => $user
                    ],
                ], 200);
            }

            return response()->json([
                'status' => false,
                'code' => 422,
                'message' => __('verify error'),
                'errors' => [
                    "code" => __("Code is incorrect")
                ],
            ], 422);
        }

        return response()->json([
            'status' => false,
            'code' => 422,
            'message' => __("Please check the data entered"),
            'errors' => [],
        ], 422);
    }
}
