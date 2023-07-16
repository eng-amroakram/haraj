<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    use Helpers;

    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function info()
    {
        return $this->apiResponseMessage(true, 200, __('Profile information retrieved successfully'), ["user" => auth()->user()]);
    }

    public function store()
    {
        $validator = Validator::make([
            "name" => $this->request->name,
            "phone" => $this->request->phone,
        ], [
            "name" => ['required', 'string', 'max:255'],
            "phone" => ['required', 'string', 'max:10', 'unique:users,phone,' . auth()->user()->id . ',id'],
        ], [
            "name.required" => __("This field is required"),
            "name.string" => __("Enter a valid name please"),
            "name.max" => __("Name must be less than 255 characters"),
            "phone.required" => __("This field is required"),
            "phone.string" => __("Enter a valid phone please"),
            "phone.max" => __("Phone must be less than 10 characters"),
            "phone.unique" => __("Phone is already taken"),
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return $this->apiResponseMessage(null, 422, __('validation error'), $errors);
        }

        if ($validator->passes()) {
            $data = $validator->validated();

            $user = User::data()->where('id', auth()->user()->id)->first();
            $user->update($data);
            return $this->apiResponseMessage(true, 200, __('Profile updated successfully'), ["user" => $user]);
        }
    }

    public function logout()
    {
        $user = auth()->user();
        $user->tokens()->delete();
        return $this->apiResponseMessage(true, 200, __('Logged out successfully'), []);
    }

    public function changeEmail()
    {
        $validator = Validator::make([
            "email" => $this->request->email,
        ], [
            "email" => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . auth()->user()->id . ',id'],
        ], [
            "email.required" => __("This field is required"),
            "email.string" => __("Enter a valid email please"),
            "email.email" => __("Enter a valid email please"),
            "email.max" => __("Email must be less than 255 characters"),
            "email.unique" => __("Email is already taken"),
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return $this->apiResponseMessage(false, 422, __('validation error'), $errors);
        }

        if ($validator->passes()) {
            $data = $validator->validated();

            $user = User::data()->where('id', auth()->user()->id)->first();
            $user->update([
                "email" => $data['email'],
            ]);
            return $this->apiResponseMessage(true, 200, __('Email updated successfully'), ["user" => $user]);
        }
    }

    public function changePassword()
    {
        $validator = Validator::make([
            "password" => $this->request->password,
            "new_password" => $this->request->new_password,
            "new_password_confirmation" => $this->request->new_password_confirmation,
        ], [
            "password" => ['required', 'string'],
            "new_password" => ['required', 'string', 'min:8', 'confirmed'],
            "new_password_confirmation" => ['required', 'string', 'min:8'],
        ], [
            "password.required" => __("This field is required"),
            "password.string" => __("Enter a valid password please"),
            "new_password.required" => __("This field is required"),
            "new_password.string" => __("Enter a valid password please"),
            "new_password.min" => __("Password must be at least 8 characters"),
            "new_password.confirmed" => __("Password confirmation does not match"),
            "new_password_confirmation.required" => __("This field is required"),
            "new_password_confirmation.string" => __("Enter a valid password please"),
            "new_password_confirmation.min" => __("Password must be at least 8 characters"),
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return $this->apiResponseMessage(false, 422, __('validation error'), $errors);
        }

        if ($validator->passes()) {
            $data = $validator->validated();

            $user = User::data()->where('id', auth()->user()->id)->first();
            if (Hash::check($data['password'], $user->password)) {
                $user->update([
                    "password" => Hash::make($data['new_password']),
                ]);

                return $this->apiResponseMessage(true, 200, __('Password updated successfully'), ["user" => $user]);
            } else {
                return $this->apiResponseMessage(false, 422, __('Password is incorrect'), []);
            }
        }
    }

    public function destroy()
    {
        $user = User::data()->where('id', auth()->user()->id)->first();
        $user->delete();
        return $this->apiResponseMessage(true, 200, __('Account deleted successfully'), []);
    }
}
