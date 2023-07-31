<?php

namespace App\Http\Controllers\Panel;
use App\Http\Controllers\Controller;

class PrincedomController extends Controller
{
    public function princedoms()
    {
        return view('panel.table', ['service' => 'PrincedomsService', 'title' => 'الأمارات']);
    }
}
