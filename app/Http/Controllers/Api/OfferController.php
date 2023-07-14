<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OfferController extends Controller
{
    public function index(Request $request)
    {
        $filters = [];
        $offers = Offer::data()->filters($filters)->get();
        return response()->json([
            'status' => true,
            'status_code' => 200,
            'message' => __('Offers retrieved successfully'),
            'data' => [
                'cars' => $offers,
            ],
        ]);
    }

    public function show(Request $request, $id)
    {
        $offer = Offer::data()->find($id);
        if (!$offer) {
            return response()->json([
                'status' => false,
                'code' => 404,
                'message' => __('Offer not found'),
            ], 404);
        }

        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => __('Offer retrieved successfully'),
            'data' => [
                'offer' => $offer,
            ],
        ]);
    }

    public function store(Request $request)
    {
        $rules = Offer::getRules();
        $messages = Offer::getMessages();
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'status' => false,
                'code' => 422,
                'message' => __('Offer error'),
                'errors' => $errors,
            ], 422);
        }

        if ($validator->passes()) {

            $data = $validator->validated();

            $offer = Offer::store($data);

            return response()->json([
                'status' => true,
                'code' => 201,
                'message' => __('Offer created successfully'),
                'data' => [
                    'offer' => $offer,
                ],
            ], 201);
        }
    }

    public function update(Request $request, $id)
    {
        $offer = Offer::find($id);
        if (!$offer) {
            return response()->json([
                'status' => false,
                'code' => 404,
                'message' => __('Offer not found'),
            ], 404);
        }

        $offer = Offer::updateModel($request->all(), $id);

        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => __('Offer updated successfully'),
            'data' => [
                'offer' => $offer,
            ],
        ], 200);
    }

    public function destroy(Request $request, $id)
    {
        $offer = Offer::find($id);
        if (!$offer) {
            return response()->json([
                'status' => false,
                'code' => 404,
                'message' => __('Offer not found'),
            ], 404);
        }

        $message = Offer::deleteModel($id);

        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => $message,
        ], 200);
    }

    public function accept(Request $request, $id)
    {
        $offer = Offer::find($id);
        $offer->update(['status' => 'accepted']);
        return response()->json([
            'status' => true,
            'status_code' => 200,
            'message' => __('Offer accepted successfully'),
        ]);
    }

    public function reject(Request $request, $id)
    {
        $offer = Offer::find($id);
        $offer->update(['status' => 'rejected']);
        return response()->json([
            'status' => true,
            'status_code' => 200,
            'message' => __('Offer rejected successfully'),
        ]);
    }

    public function getBuyerOffers()
    {
        $filters['status'] = request()->status ? [request()->status] : null;

        $offers = Offer::data()->where('buyer_id', auth()->id())->filters($filters)->get();

        return response()->json([
            'status' => true,
            'status_code' => 200,
            'message' => __('Offers retrieved successfully'),
            'data' => [
                'offers' => $offers,
            ],
        ]);
    }

    public function getSellerOffers()
    {
        $filters['status'] = request()->status ? [request()->status] : null;

        $offers = Offer::data()->where('seller_id', auth()->id())->filters($filters)->get();

        return response()->json([
            'status' => true,
            'status_code' => 200,
            'message' => __('Offers retrieved successfully'),
            'data' => [
                'offers' => $offers,
            ],
        ]);
    }
}
