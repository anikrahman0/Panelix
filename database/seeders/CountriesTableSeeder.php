<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Country::truncate();
        // Define an array of countries
        $countries = [
            [
                'id' => 1,
                'country_name' => 'Bangladesh',
                'country_flag' => 'flag-bangladesh-1727164329.webp',
                'country_code' => 'BD',
                'phone_code' => '+880',
                'language' => 'Bangla',
                'language_code' => 'BN',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => NULL,
            ],
        ];

        // Insert the array into the countries table
        DB::table('countries')->insert($countries);
    }
}
