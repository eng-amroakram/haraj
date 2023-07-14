<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function users()
    {
        return view('panel.table', ['service' => 'UsersService', 'title' => 'المستخدمين']);
    }
}
