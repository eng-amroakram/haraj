<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Services\Services;
use App\Traits\Helpers;

class FeatureController extends Controller
{
    use Helpers;

    public function index($feature)
    {
        $array = [
            "BodyType",
            "Transmission",
            "FuelType",
            "CarModel",
            "CarCondition",
            "Cylinder",
            "Door",
            "EnginePower",
            "InnerColor",
            "Insurance",
            "MechanicalCondition",
            "OuterColor",
            "RegionalSpecification",
            "Seat",
            "SellerType",
            "Year",
            "AdditionalFeature",
            'City',
            'Princedom',
        ];

        $model = Services::createModelInstance($feature);

        if (!in_array($feature, $array) || !$model) {
            return $this->apiResponseMessage(false, 404, __('Feature not found'));
        }

        $name = 'name_en';

        if (app()->getLocale() == 'ar') {
            $name = 'name_ar';
        }

        return $model::data()->where('status', 'active')->pluck($name, 'id')->mapWithKeys(function ($name, $id) {
            return [$name => (string)$id];
        })->toArray();
    }
}
