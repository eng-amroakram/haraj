<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CarController extends Controller
{
    // index, show, store, update, destroy

    public function index()
    {
        $cars = Car::select(['id', 'title', 'model', 'year', 'price',])->get();

        return response()->json([
            'status' => true,
            'message' => __('Ads retrieved successfully'),
            'data' => [
                'cars' => $cars,
            ],
        ]);
    }

    public function show($id)
    {
        $car = Car::select(['id', 'title', 'model', 'year', 'price',])->find($id);

        if (!$car) {
            return response()->json([
                'status' => false,
                'code' => 404,
                'message' => __('Ads not found'),
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => __('Ads retrieved successfully'),
            'data' => [
                'car' => $car,
            ],
        ]);
    }

    public function store(Request $request)
    {
        $rules = Car::getRules();
        $messages = Car::getMessages();
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'status' => false,
                'code' => 422,
                'message' => __('Ads error'),
                'errors' => $errors,
            ], 422);
        }

        if ($validator->passes()) {
            $data = $validator->validated();

            $car = Car::store($data);

            return response()->json([
                'status' => true,
                'code' => 201,
                'message' => __('Ads created successfully'),
                'data' => [
                    'car' => $car,
                ],
            ], 201);
        }
    }

    public function update(Request $request, $id)
    {
        $rules = Car::getRules();
        $messages = Car::getMessages();
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'status' => false,
                'code' => 422,
                'message' => __('Ads error'),
                'errors' => $errors,
            ], 422);
        }

        $car = Car::find($id);

        if (!$car) {
            return response()->json([
                'status' => false,
                'code' => 404,
                'message' => __('Ads not found'),
            ], 404);
        }

        if ($validator->passes()) {
            $data = $validator->validated();

            $message = Car::updateModel($data, $id);

            $car = Car::find($id);

            if ($message) {
                return response()->json([
                    'status' => true,
                    'code' => 200,
                    'message' => $message,
                    'data' => [
                        'car' => $car,
                    ],
                ], 200);
            }
        }

        return response()->json([
            'status' => false,
            'code' => 422,
            'message' => __('Ads error'),
        ], 422);
    }

    public function destroy($id)
    {
        $car = Car::find($id);

        if (!$car) {
            return response()->json([
                'status' => false,
                'code' => 404,
                'message' => __('Ads not found'),
            ], 404);
        }

        $message = Car::deleteModel($id);

        if ($message) {
            return response()->json([
                'status' => true,
                'code' => 200,
                'message' => $message,
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'code' => 422,
                'message' => $message,
            ], 422);
        }
    }

    public function favorite($id)
    {
        $car = Car::find($id);

        if (!$car) {
            return response()->json([
                'status' => false,
                'code' => 404,
                'message' => __('Ads not found'),
            ], 404);
        }

        $message = Car::favoriteModel($id);

        if ($message) {
            return response()->json([
                'status' => true,
                'code' => 200,
                'message' => $message,
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'code' => 422,
                'message' => $message,
            ], 422);
        }
    }

    public function unfavorite($id)
    {
        $car = Car::find($id);

        if (!$car) {
            return response()->json([
                'status' => false,
                'code' => 404,
                'message' => __('Ads not found'),
            ], 404);
        }

        $message = Car::unfavoriteModel($id);

        if ($message) {
            return response()->json([
                'status' => true,
                'code' => 200,
                'message' => $message,
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'code' => 422,
                'message' => $message,
            ], 422);
        }
    }

    public function favorites()
    {
        $cars = Car::favorites();

        return response()->json([
            'status' => true,
            'message' => __('Ads retrieved successfully'),
            'data' => [
                'cars' => $cars,
            ],
        ]);
    }

    public function myads()
    {
        $cars = Car::myads();

        return response()->json([
            'status' => true,
            'message' => __('Ads retrieved successfully'),
            'data' => [
                'cars' => $cars,
            ],
        ]);
    }
}
