<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function offers()
    {
        return view('panel.table', ['service' => 'OffersService', 'title' => 'العروض']);
    }
}
