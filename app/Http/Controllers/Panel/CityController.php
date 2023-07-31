<?php

namespace App\Http\Controllers\Panel;
use App\Http\Controllers\Controller;

class CityController extends Controller
{
    public function cities()
    {
        return view('panel.table', ['service' => 'CitiesService', 'title' => 'المدن']);
    }
}
