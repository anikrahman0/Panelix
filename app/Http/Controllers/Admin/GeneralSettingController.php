<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\GeneralSetting;
use App\Library\CommonFunctions;
use App\Http\Controllers\Controller;
use App\Http\Requests\GeneralSettingValidationRequest;
use App\Services\Admin\SettingsCrudService;

class GeneralSettingController extends Controller
{
    public function edit()
    {
        $setting = SettingsCrudService::getEditData();
        return view('layouts.admin.dashboard.general-setting.edit', $setting);
    }
    public function update(GeneralSettingValidationRequest $request)
    {
        $setting = (new SettingsCrudService())->updateSettings($request);
        return to_route('admin.general-setting.edit')->with('success', $setting['message']);
    }
}
