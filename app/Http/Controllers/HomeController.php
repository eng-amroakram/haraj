<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // 認証済みユーザの場合、Home画面へリダイ

        $user = auth()->user();

        if ($user) {
            if ($user->type == "admin") {
                return redirect()->route('panel.home');
            }

            return "Login Success";
        }

        return redirect()->route('auth.login');
    }

    public function login()
    {
        return view('auth.login');
    }
}
