<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function data(Request $request)
    {
        $setting = Setting::get($request->setting);
        return $setting;
    }
}
