<?php

use App\Models\Car;
use App\Models\User;

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
