<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\User;
use App\Traits\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CarController extends Controller
{
    // index, show, store, update, destroy
    use Helpers;

    public function index()
    {
        $cars = Car::select(['id', 'title', 'model', 'year', 'price',])->get();
        return $this->apiResponseMessage(true, 200, __('Ads retrieved successfully'), ['cars' => $cars]);
    }

    public function show($id)
    {
        $car = Car::select(['id', 'title', 'model', 'year', 'price',])->find($id);

        if (!$car) {
            return $this->apiResponseMessage(false, 404, __('Ads not found'), []);
        }

        return $this->apiResponseMessage(true, 200, __('Ads retrieved successfully'), ['car' => $car]);
    }

    public function store(Request $request)
    {
        $rules = Car::getRules();
        $messages = Car::getMessages();
        $data = $request->all();
        $data['additional_features'] = json_decode($request->all()['additional_features']);

        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return $this->apiResponseMessage(false, 422, __('Ads error'), $errors);
        }

        if ($validator->passes()) {
            $data = $validator->validated();
            $car = Car::store($data);
            return $this->apiResponseMessage(true, 201, __('Ad created successfully'), ['car' => $car]);
        }
    }

    public function update(Request $request, $id)
    {
        $rules = Car::getRules();
        $messages = Car::getMessages();
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return $this->apiResponseMessage(false, 422, __('Ads error'), $errors);
        }

        $car = Car::find($id);

        if (!$car) {
            return $this->apiResponseMessage(false, 404, __('Ads not found'));
        }

        if ($validator->passes()) {
            $data = $validator->validated();

            $message = Car::updateModel($data, $id);

            $car = Car::find($id);

            if ($message) {
                return $this->apiResponseMessage(true, 200, $message, ['car' => $car]);
            }
        }
        return $this->apiResponseMessage(true, 422, $message);
    }

    public function destroy($id)
    {
        $car = Car::find($id);

        if (!$car) {
            return $this->apiResponseMessage(false, 404, __('Ads not found'));
        }

        $message = Car::deleteModel($id);

        if ($message) {
            return $this->apiResponseMessage(true, 200, $message);
        } else {
            return $this->apiResponseMessage(false, 422, $message);
        }
    }

    public function favorite($id)
    {
        $car = Car::find($id);

        if (!$car) {
            return $this->apiResponseMessage(false, 404, __('Ads not found'));
        }

        $message = Car::favoriteModel($id);

        if ($message) {
            return $this->apiResponseMessage(true, 200, $message);
        } else {
            return $this->apiResponseMessage(false, 422, $message);
        }
    }

    public function unfavorite($id)
    {
        $car = Car::find($id);

        if (!$car) {
            return $this->apiResponseMessage(false, 404, __('Ads not found'));
        }

        $message = Car::unfavoriteModel($id);

        if ($message) {
            return $this->apiResponseMessage(true, 200, $message);
        } else {
            return $this->apiResponseMessage(false, 422, $message);
        }
    }

    public function favorites()
    {
        $cars = Car::favorites();
        $data = ['cars' => $cars];
        return $this->apiResponseMessage(true, 200, __('Ads retrieved successfully'), $data);
    }

    public function myads()
    {
        $cars = Car::myads();
        $data = ['cars' => $cars];
        return $this->apiResponseMessage(true, 200, __('Ads retrieved successfully'), $data);
    }

    public function favoriteADS()
    {
        $user = User::find(auth()->id());
        $data = ['cars' => $user->favoriteAds];
        return $this->apiResponseMessage(true, 200, __('Ads retrieved successfully'), $data);
    }
}
