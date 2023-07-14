<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
    ];

    protected $casts = [
        'value' => 'array',
    ];

    public static function get($key, $default = null)
    {
        $setting = static::where('key', $key)->first();

        if ($setting) {
            return $setting->value;
        }

        return $default;
    }

    public static function set($key, $value = null)
    {
        $setting = static::firstOrNew(['key' => $key]);

        $setting->value = $value;

        $setting->save();

        return $setting;
    }

    public static function forget($key)
    {
        $setting = static::where('key', $key)->first();

        if ($setting) {
            return $setting->delete();
        }

        return false;
    }

    public static function has($key)
    {
        return static::where('key', $key)->exists();
    }

    public static function allToArray()
    {
        $settings = static::all();

        $array = [];

        foreach ($settings as $setting) {
            $array[$setting->key] = $setting->value;
        }

        return $array;
    }

    public static function allToArrayWithKeys()
    {
        $settings = static::all();

        $array = [];

        foreach ($settings as $setting) {
            $array[$setting->key] = $setting->value;
        }

        return $array;
    }



}
