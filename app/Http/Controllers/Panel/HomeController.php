<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('web');
    }

    public function home()
    {
        return view('panel.home',['title' => 'الرئيسية']);
    }
}
