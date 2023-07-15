<?php

use App\Models\AdditionalFeature;
use App\Models\BodyType;
use App\Models\Car;
use App\Models\CarCondition;
use App\Models\CarModel;
use App\Models\Cylinder;
use App\Models\Door;
use App\Models\EnginePower;
use App\Models\FuelType;
use App\Models\InnerColor;
use App\Models\Insurance;
use App\Models\MechanicalCondition;
use App\Models\OuterColor;
use App\Models\RegionalSpecification;
use App\Models\Seat;
use App\Models\SellerType;
use App\Models\Transmission;
use App\Models\User;
use App\Models\Year;

if (!function_exists('models_count')) {
    function models_count($type)
    {
        if ($type == "cars") {
            return Car::count();
        }

        if ($type == "cars-rejected") {
            return Car::where("status", "rejected")->count();
        }

        if ($type == "cars-approved") {
            return Car::where("status", "approved")->count();
        }

        if ($type == "cars-new") {
            return Car::where("status", "new")->count();
        }

        if ($type == "users") {
            return User::count();
        }
    }
}

if (!function_exists('doors')) {
    function doors($search = null)
    {
        if ($search) {
            return Door::data()->where('status', 'active')->pluck('name_ar', 'id')->mapWithKeys(function ($name, $id) {
                return [$name => $id];
            })->toArray();
        }
        return Door::data()->get();
    }
}

if (!function_exists('cylinders')) {
    function cylinders($search = null)
    {
        if ($search) {
            return Cylinder::data()->where('status', 'active')->pluck('name_ar', 'id')->mapWithKeys(function ($name, $id) {
                return [$name => $id];
            })->toArray();
        }
        return Cylinder::data()->get();
    }
}

if (!function_exists('insurances')) {
    function insurances($search = null)
    {
        if ($search) {
            return Insurance::data()->where('status', 'active')->pluck('name_ar', 'id')->mapWithKeys(function ($name, $id) {
                return [$name => $id];
            })->toArray();
        }
        return Insurance::data()->get();
    }
}

if (!function_exists('car_conditions')) {
    function car_conditions($search = null)
    {
        if ($search) {
            return CarCondition::data()->where('status', 'active')->pluck('name_ar', 'id')->mapWithKeys(function ($name, $id) {
                return [$name => $id];
            })->toArray();
        }
        return CarCondition::data()->get();
    }
}

if (!function_exists('body_types')) {
    function body_types($search = null)
    {
        if ($search) {
            return BodyType::data()->where('status', 'active')->pluck('name_ar', 'id')->mapWithKeys(function ($name, $id) {
                return [$name => $id];
            })->toArray();
        }
        return BodyType::data()->get();
    }
}

if (!function_exists('fuel_types')) {
    function fuel_types($search = null)
    {
        if ($search) {
            return FuelType::data()->where('status', 'active')->pluck('name_ar', 'id')->mapWithKeys(function ($name, $id) {
                return [$name => $id];
            })->toArray();
        }
        return FuelType::data()->get();
    }
}

if (!function_exists('car_models')) {
    function car_models($search = null)
    {
        if ($search) {
            return CarModel::data()->where('status', 'active')->pluck('name_ar', 'id')->mapWithKeys(function ($name, $id) {
                return [$name => $id];
            })->toArray();
        }
        return CarModel::data()->get();
    }
}

if (!function_exists('engine_powers')) {
    function engine_powers($search = null)
    {
        if ($search) {
            return EnginePower::data()->where('status', 'active')->pluck('name_ar', 'id')->mapWithKeys(function ($name, $id) {
                return [$name => $id];
            })->toArray();
        }

        return EnginePower::data()->get();
    }
}

if (!function_exists('inner_colors')) {
    function inner_colors($search = null)
    {
        if ($search) {
            return InnerColor::data()->where('status', 'active')->pluck('name_ar', 'id')->mapWithKeys(function ($name, $id) {
                return [$name => $id];
            })->toArray();;
        }
        return InnerColor::data()->get();
    }
}

if (!function_exists('outer_colors')) {
    function outer_colors($search = null)
    {
        if ($search) {
            return OuterColor::data()->where('status', 'active')->pluck('name_ar', 'id')->mapWithKeys(function ($name, $id) {
                return [$name => $id];
            })->toArray();;
        }
        return OuterColor::data()->get();
    }
}

if (!function_exists('mechanical_conditions')) {
    function mechanical_conditions($search = null)
    {
        if ($search) {
            return MechanicalCondition::data()->where('status', 'active')->pluck('name_ar', 'id')->mapWithKeys(function ($name, $id) {
                return [$name => $id];
            });
        }
        return MechanicalCondition::data()->get();
    }
}

if (!function_exists('regional_specifications')) {
    function regional_specifications($search = null)
    {
        if ($search) {
            return RegionalSpecification::data()->where('status', 'active')->pluck('name_ar', 'id')->mapWithKeys(function ($name, $id) {
                return [$name => $id];
            });
        }
        return RegionalSpecification::data()->get();
    }
}

if (!function_exists('seats')) {
    function seats($search = null)
    {
        if ($search) {
            return Seat::data()->where('status', 'active')->pluck('name_ar', 'id')->mapWithKeys(function ($name, $id) {
                return [$name => $id];
            });
        }
        return Seat::data()->get();
    }
}

if (!function_exists('seller_types')) {
    function seller_types($search = null)
    {
        if ($search) {
            return SellerType::data()->where('status', 'active')->pluck('name_ar', 'id')->mapWithKeys(function ($name, $id) {
                return [$name => $id];
            });
        }
        return SellerType::data()->get();
    }
}

if (!function_exists('transmissions')) {
    function transmissions($search = null)
    {
        if ($search) {
            return Transmission::data()->where('status', 'active')->pluck('name_ar', 'id')->mapWithKeys(function ($name, $id) {
                return [$name => $id];
            });
        }
        return Transmission::data()->get();
    }
}

if (!function_exists('years')) {
    function years($search = null)
    {
        if ($search) {
            return Year::data()->where('status', 'active')->pluck('name_ar', 'id')->mapWithKeys(function ($name, $id) {
                return [$name => $id];
            });
        }
        return Year::data()->get();
    }
}

if (!function_exists('additional_features')) {
    function additional_features($search = null)
    {
        if ($search) {
            return AdditionalFeature::data()->where('status', 'active')->pluck('name_ar', 'id')->mapWithKeys(function ($name, $id) {
                return [$name => $id];
            });
        }
        return AdditionalFeature::data()->get();
    }
}


