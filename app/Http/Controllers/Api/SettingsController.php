<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Settings::allToArrayWithKeys();
        return response()->json([
            'status' => true,
            'message' => __('Settings fetched successfully!'),
            'settings' => $settings,
            'code' => 200
        ], 200);
    }
}
