<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
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
            "id_number" => $this->request->id_number,
            "nick_name" => $this->request->nick_name,
            "image" => $this->request->image,
        ], [
            "name" => ['nullable', 'string', 'max:255'],
            "phone" => ['nullable', 'string', 'max:10', 'unique:users,phone,' . auth()->id() . ',id'],
            "id_number" => ['nullable', 'string', 'max:10', 'unique:users,id_number,' . auth()->id() . ',id'],
            "nick_name" => ['nullable', 'string', 'max:10', 'unique:users,nick_name,' . auth()->id() . ',id'],
            "image" => ['nullable', 'max:1024'],
        ], [
            "name.string" => __("Enter a valid name please"),
            "name.max" => __("Name must be less than 255 characters"),
            "phone.string" => __("Enter a valid phone please"),
            "phone.max" => __("Phone must be less than 10 characters"),
            "phone.unique" => __("Phone is already taken"),
            "id_number.unique" => __("ID number is already taken"),
            "nick_name.unique" => __("Nick name is already taken"),
            "image.max" => __("Image must be less than 1024 kilobytes"),
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return $this->apiResponseMessage(false, 422, __('validation error'), $errors);
        }

        if ($validator->passes()) {

            $data = $validator->validated();

            User::updateModel($data, auth()->id());

            $user = User::data()->find(auth()->id());

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
        $user = User::data()->where('id', auth()->id())->first();
        $user->delete();
        return $this->apiResponseMessage(true, 200, __('Account deleted successfully'), []);
    }

    public function gallery()
    {
        $user = auth()->user();

        $validator = Validator::make([
            "name" => $this->request->name,
            "image" => $this->request->image,
            "phone" => $this->request->phone,
            "email" => $this->request->email,
            "brief" => $this->request->brief,
            "commercial_registration_no" => $this->request->commercial_registration_no,
            "princedom_id" => $this->request->princedom_id,
            "city_id" => $this->request->city_id,
            "location" => $this->request->location,
            "street_name" => $this->request->street_name,
            "building_number" => $this->request->building_number,
            "zip_code" => $this->request->zip_code,
        ], [
            "name" => ['nullable', 'string', 'max:255'],
            "image" => ['nullable', 'max:2048'],
            "phone" => ['nullable', 'string', 'max:10', 'unique:galleries,phone,' . $user->gallery->id],
            "email" => ['nullable', 'string', 'email', 'max:255', 'unique:galleries,email,' . $user->gallery->id],
            "brief" => ['nullable', 'string', 'max:500'],
            "commercial_registration_no" => ['nullable', 'string'],
            "princedom_id" => ['nullable', 'exists:princedoms,id'],
            "city_id" => ['nullable',  'exists:cities,id'],
            "location" => ['nullable', 'string'],
            "street_name" => ['nullable', 'string'],
            "building_number" => ['nullable', 'string'],
            "zip_code" => ['nullable', 'string'],
        ], [
            "name.string" => __("Enter a valid name please"),
            "name.max" => __("Name must be less than 255 characters"),
            "image" => __("Enter a valid image please"),
            "phone.string" => __("Enter a valid phone please"),
            "phone.max" => __("Phone must be less than 10 characters"),
            "phone.unique" => __("Phone is already taken"),
            "email.string" => __("Enter a valid email please"),
            "email.email" => __("Enter a valid email please"),
            "email.max" => __("Email must be less than 255 characters"),
            "email.unique" => __("Email is already taken"),
            "brief.string" => __("Enter a valid brief please"),
            "brief.max" => __("Brief must be less than 500 characters"),
            "commercial_registration_no.string" => __("Enter a valid commercial registration no please"),
            "princedom_id.required" => __("This field is required"),
            "princedom_id.exists" => __("Enter a valid princedom please"),
            "city_id.exists" => __("Enter a valid city please"),
            "location.string" => __("Enter a valid location please"),
            "street_name.string" => __("Enter a valid street name please"),
            "building_number.string" => __("Enter a valid building number please"),
            "zip_code.string" => __("Enter a valid zip code please"),
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return $this->apiResponseMessage(false, 422, __('validation error'), $errors);
        }

        if ($validator->passes()) {
            $data = $validator->validated();

            $gallery = Gallery::updateModel($data);

            return $this->apiResponseMessage(true, 200, __('Gallery updated successfully'), ["gallery" => $gallery]);
        }
    }
}
