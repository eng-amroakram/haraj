<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function cars()
    {
        return view('panel.table', ['service' => 'CarsService', 'title' => 'الإعلانات']);
    }
}
