<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Traits\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OfferController extends Controller
{
    use Helpers;

    public function index(Request $request)
    {
        $filters = [];
        $offers = Offer::data()->filters($filters)->get();
        return $this->apiResponseMessage(true, 200, __('Offers retrieved successfully'), ['offers' => $offers]);
    }

    public function show(Request $request, $id)
    {
        $offer = Offer::data()->find($id);
        if (!$offer) {
            return $this->apiResponseMessage(false, 404, __('Offer not found'));
        }
        return $this->apiResponseMessage(true, 200, __('Offer retrieved successfully'), ['offer' => $offer]);
    }

    public function store(Request $request)
    {
        $rules = Offer::getRules();
        $messages = Offer::getMessages();
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return $this->apiResponseMessage(false, 422, __('Offer error'), $errors);
        }

        if ($validator->passes()) {
            $data = $validator->validated();
            $offer = Offer::store($data);
            return $this->apiResponseMessage(true, 201, __('Offer created successfully'), ['offer' => $offer]);
        }
    }

    public function update(Request $request, $id)
    {
        $offer = Offer::find($id);
        if (!$offer) {
            return $this->apiResponseMessage(false, 404, __('Offer not found'));
        }

        $offer = Offer::updateModel($request->all(), $id);
        return $this->apiResponseMessage(true, 200, __('Offer updated successfully'), ['offer' => $offer]);
    }

    public function destroy(Request $request, $id)
    {
        $offer = Offer::find($id);
        if (!$offer) {
            return $this->apiResponseMessage(false, 404, __('Offer not found'));
        }

        $message = Offer::deleteModel($id);
        return $this->apiResponseMessage(true, 200, $message);
    }

    public function accept(Request $request, $id)
    {
        $offer = Offer::find($id);
        $offer->update(['status' => 'accepted']);
        return $this->apiResponseMessage(true, 200, __('Offer accepted successfully'));
    }

    public function reject(Request $request, $id)
    {
        $offer = Offer::find($id);
        $offer->update(['status' => 'rejected']);
        return $this->apiResponseMessage(true, 200, __('Offer rejected successfully'));
    }

    public function getBuyerOffers()
    {
        $filters['status'] = request()->status ? [request()->status] : null;
        $offers = Offer::data()->where('buyer_id', auth()->id())->filters($filters)->get();
        return $this->apiResponseMessage(true, 200, __('Offers retrieved successfully'), ['offers' => $offers]);
    }

    public function getSellerOffers()
    {
        $filters['status'] = request()->status ? [request()->status] : null;
        $offers = Offer::data()->where('seller_id', auth()->id())->filters($filters)->get();
        return $this->apiResponseMessage(true, 200, __('Offers retrieved successfully'), ['offers' => $offers]);
    }
}
