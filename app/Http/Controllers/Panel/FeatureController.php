<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FeatureController extends Controller
{
    public function features()
    {
        return view('panel.features', ['title' => 'المميزات',]);
    }

    public function doors()
    {
        return view('panel.table', ['service' => 'DoorsService', 'title' => 'عدد الأبواب']);
    }

    public function cylinders()
    {
        return view('panel.table', ['service' => 'CylindersService', 'title' => 'عدد السلندرات']);
    }

    public function seats()
    {
        return view('panel.table', ['service' => 'SeatsService', 'title' => 'عدد المقاعد']);
    }

    public function bodyTypes()
    {
        return view('panel.table', ['service' => 'BodyTypesService', 'title' => 'نوع الهيكل']);
    }

    public function fuelTypes()
    {
        return view('panel.table', ['service' => 'FuelTypesService', 'title' => 'نوع الوقود']);
    }

    public function carModels()
    {
        return view('panel.table', ['service' => 'CarModelsService', 'title' => 'الموديلات']);
    }

    public function enginePowers()
    {
        return view('panel.table', ['service' => 'EnginePowersService', 'title' => "قوة المحرك"]);
    }

    public function transmissions()
    {
        return view('panel.table', ['service' => 'TransmissionsService', 'title' => 'نوع الناقل']);
    }

    public function innerColors()
    {
        return view('panel.table', ['service' => 'InnerColorsService', 'title' => 'اللون الداخلي']);
    }

    public function outerColors()
    {
        return view('panel.table', ['service' => 'OuterColorsService', 'title' => 'اللون الخارجي']);
    }

    public function sellerTypes()
    {
        return view('panel.table', ['service' => 'SellerTypesService', 'title' => 'نوع البائع']);
    }

    public function years()
    {
        return view('panel.table', ['service' => 'YearsService', 'title' => 'السنوات']);
    }

    public function mechanicalConditions()
    {
        return view('panel.table', ['service' => 'MechanicalConditionsService', 'title' => 'الحالة الميكانيكية']);
    }

    public function regionalSpecifications()
    {
        return view('panel.table', ['service' => 'RegionalSpecificationsService', 'title' => 'المواصفات الإقليمية']);
    }

    public function carConditions()
    {
        return view('panel.table', ['service' => 'CarConditionsService', 'title' => 'حالة السيارة']);
    }
}
