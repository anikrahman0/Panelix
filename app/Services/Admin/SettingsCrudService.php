<?php
namespace App\Services\Admin;

use App\Library\CacheHelper;
use App\Models\GeneralSetting;
use App\Library\CommonFunctions;
use App\Http\Requests\GeneralSettingValidationRequest;

class SettingsCrudService
{
    public static function getEditData()
    {
        $setting = GeneralSetting::where('status', 1)->first();

        if (!$setting) {
            $setting = GeneralSetting::create([
                'site_title'          => '',
                'site_url'            => '',
                'site_description'    => '',
                'copyright_text'      => '',
                'address'             => '',
                'default_email'       => '',
                'default_phone'       => '',
                'timezone'            => '',
                'logo'                => '',
                'fb_logo'             => '',
                'favicon'             => '',
                'notice'              => '',
                'status'              => 1,
            ]);
            self::settingsCacheRemove();
        }
        return [
            'setting'   => $setting,        ];
    }
    public static function updateSettings(GeneralSettingValidationRequest $request)
    {
        $validated = $request->validated();
        $setting = GeneralSetting::where('status', 1)->first();

        if (!$setting) {
            $setting = GeneralSetting::create([
                'site_title'          => '',
                'site_url'            => '',
                'site_description'    => '',
                'copyright_text'      => '',
                'address'             => '',
                'default_email'       => '',
                'default_phone'       => '',
                'timezone'            => '',
                'logo'                => '',
                'fb_logo'             => '',
                'favicon'             => '',
                'notice'              => '',
                'status'              => 1,
            ]);
        }
        // Fields that may be removed or uploaded
        $fields = [
            'logo',
            'fb_logo',
            'favicon',
        ];

        // Handle removals and uploads
        foreach ($fields as $field) {
            if ($request->has("{$field}_remove")) {
                $validated[$field] = null;
            }

            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $fileName = CommonFunctions::imageUpload($file, 'media/uploads/general-setting');
                $validated[$field] = $fileName;
            }
        }
        // Single update call
        if (!empty($validated)) {
            $setting->update($validated);
        }
        $data['setting'] = $setting;
        $data['message'] = 'Setting updated successfully';
        self::settingsCacheRemove();
        return $data;
    }

    public static function settingsCacheRemove()
    {
        CacheHelper::forget('general_settings');
    } 

}