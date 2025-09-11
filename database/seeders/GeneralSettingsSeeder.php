<?php

namespace Database\Seeders;

use App\Models\GeneralSetting;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GeneralSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        GeneralSetting::truncate();
        GeneralSetting::create([
            'site_title'          => 'Panelix',
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
}
