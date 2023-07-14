<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function settings()
    {
        $settings = new Settings();
        return view('panel.settings', ['settings' => $settings, 'title' => 'الإعدادات']);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            "name" => ['nullable'],
            "email" => ['nullable'],
            "phone" => ['nullable'],
            "address" => ['nullable'],
            "facebook" => ['nullable'],
            "twitter" => ['nullable'],
            "who_we_are" => ['nullable'],
            "tomorrow_company" => ['nullable'],
            "who_do_we_serve" => ['nullable'],
            "our_goals" => ['nullable'],
            "terms_service_cancellation" => ['nullable'],
            "account_security" => ['nullable'],
            "rights_protection" => ['nullable'],
            "monitoring_reservations" => ['nullable'],
        ]);

        $settings = new Settings();
        foreach ($data as $key => $value) {
            $settings->set($key, $value);
        }

        return redirect()->route('panel.settings.index')->with('success', __('Settings saved successfully!'));
    }
}
