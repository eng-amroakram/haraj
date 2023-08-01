<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\User;
use App\Traits\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use Helpers;
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
            return $this->apiResponseMessage(false, 422, __('login error'), $errors);
        }

        if ($validator->passes()) {
            $data = $validator->validated();

            $user = User::data()->where('email', $data['email'])->first();
            $user->is_verify = $user->is_verify;

            if ($user && Hash::check($data['password'], $user->password)) {
                // generate token and save it in database
                $token = $user->createToken("Device Name", ['*']);
                $data = [
                    "token" => $token->plainTextToken,
                    "user" => $user
                ];

                return $this->apiResponseMessage(true, 200, __('Logged in successfully'), $data);
            }
        }

        return $this->apiResponseMessage(true, 422, __("Please check the data entered"), []);
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
            return $this->apiResponseMessage(false, 422, __('register error'), $errors);
        }

        if ($validator->passes()) {
            $data = $validator->validated();

            $code = random_int(1111, 9999);

            $user = User::create([
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'type' => $data['type'], // 'seller', 'buyer'
                'status' => "active",
                "can_add_ad" => "inactive",
                "can_add_offer" => "inactive",
                "code" => null,
            ]);

            if ($data['type'] == 'seller' && $user->gallery == null && $user->type == 'seller') {
                Gallery::create([
                    "seller_id" => $user->id,
                    "name" => "",
                    "image" => "",
                    "phone" => "",
                    "email" => "",
                    "brief" => "",
                    "commercial_registration_no" => "",
                    "status" => "active",
                ]);
            }

            $user = User::data()->find($user->id);
            $user->is_verify = $user->is_verify;

            $token = $user->createToken("Device Name", ['*']);
            $data = [
                "token" => $token->plainTextToken,
                "user" => $user
            ];
            return $this->apiResponseMessage(true, 200, __('Your account has been successfully registered'), $data);
        }
    }

    public function otp()
    {
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
            return $this->apiResponseMessage(false, 422, __('verify error'), $errors);
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

                $data = [
                    "user" => $user
                ];

                return $this->apiResponseMessage(true, 200, __('Email Verified Successfully'), $data);
            }

            return $this->apiResponseMessage(true, 422, __("Code is incorrect"), []);
        }

        return $this->apiResponseMessage(true, 422, __("Please check the data entered"), []);
    }
}
