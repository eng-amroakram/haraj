<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use App\Traits\Helpers;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    use Helpers;

    public function index()
    {
        $settings = Settings::allToArrayWithKeys();
        return $this->apiResponseMessage(true, 200, __('Settings fetched successfully'), ['settings' => $settings]);
    }
}
