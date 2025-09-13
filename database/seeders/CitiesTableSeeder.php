<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        City::truncate();
        City::create([
            'id' => 1,
            'name' => 'Akhaura',
            'state_id' => 17,
        ]);

        City::create([
            'id' => 2,
            'name' => 'Ashuganj',
            'state_id' => 17,
        ]);

        City::create([
            'id' => 3,
            'name' => 'Bancharampur',
            'state_id' => 17,
        ]);

        City::create([
            'id' => 4,
            'name' => 'Bijoynagar',
            'state_id' => 17,
        ]);
    }
}
