<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        State::truncate();
        $states = [
            [
                'name' => 'Dhaka',
                'country_id' => '1',
            ],
            [
                'name' => 'Gazipur',
                'country_id' => '1',
            ],
            [
                'name' => 'Kishoreganj',
                'country_id' => '1',
            ],
            [
                'name' => 'Manikganj',
                'country_id' => '1',
            ],
            [
                'name' => 'Munshiganj',
                'country_id' => '1',
            ],
            [
                'name' => 'Narayanganj',
                'country_id' => '1',
            ],
            [
                'name' => 'Narsingdi',
                'country_id' => '1',
            ],
            [
                'name' => 'Tangail',
                'country_id' => '1',
            ],
            [
                'name' => 'Faridpur',
                'country_id' => '1',
            ],
            [
                'name' => 'Gopalganj',
                'country_id' => '1',
            ],
            [
                'name' => 'Madaripur',
                'country_id' => '1',
            ],
            [
                'name' => 'Rajbari',
                'country_id' => '1',
            ],
            [
                'name' => 'Shariatpur',
                'country_id' => '1',
            ],
            [
                'name' => 'Chittagong',
                'country_id' => '1',
            ],
            [
                'name' => 'Noakhali',
                'country_id' => '1',
            ],
            [
                'name' => 'Feni',
                'country_id' => '1',
            ],
            [
                'name' => 'Brahmanbaria',
                'country_id' => '1',
            ],
            [
                'name' => 'Comilla',
                'country_id' => '1',
            ],
            [
                'name' => 'Chandpur',
                'country_id' => '1',
            ],
            [
                'name' => 'Lakshmipur',
                'country_id' => '1',
            ],
            [
                'name' => 'Khagrachhari',
                'country_id' => '1',
            ],
            [
                'name' => 'Rangamati',
                'country_id' => '1',
            ],
            [
                'name' => 'Bandarban',
                'country_id' => '1',
            ],
            [
                'name' => 'Cox\'s Bazar',
                'country_id' => '1',
            ],
            [
                'name' => 'Bagerhat',
                'country_id' => '1',
            ],
            [
                'name' => 'Chuadanga',
                'country_id' => '1',
            ],
            [
                'name' => 'Jessore',
                'country_id' => '1',
            ],
            [
                'name' => 'Jhenaidah',
                'country_id' => '1',
            ],
            [
                'name' => 'Khulna',
                'country_id' => '1',
            ],
            [
                'name' => 'Kushtia',
                'country_id' => '1',
            ],
            [
                'name' => 'Magura',
                'country_id' => '1',
            ],
            [
                'name' => 'Meherpur',
                'country_id' => '1',
            ],
            [
                'name' => 'Narail',
                'country_id' => '1',
            ],
            [
                'name' => 'Satkhira',
                'country_id' => '1',
            ],
            [
                'name' => 'Habiganj',
                'country_id' => '1',
            ],
            [
                'name' => 'Moulvibazar',
                'country_id' => '1',
            ],
            [
                'name' => 'Sunamganj',
                'country_id' => '1',
            ],
            [
                'name' => 'Sylhet',
                'country_id' => '1',
            ],
            [
                'name' => 'Mymensingh',
                'country_id' => '1',
            ],
            [
                'name' => 'Netrokona',
                'country_id' => '1',
            ],
            [
                'name' => 'Jamalpur',
                'country_id' => '1',
            ],
            [
                'name' => 'Sherpur',
                'country_id' => '1',
            ],
            [
                'name' => 'Rajshahi',
                'country_id' => '1',
            ],
            [
                'name' => 'Natore',
                'country_id' => '1',
            ],
            [
                'name' => 'Naogaon',
                'country_id' => '1',
            ],
            [
                'name' => 'Sirajganj',
                'country_id' => '1',
            ],
            [
                'name' => 'Pabna',
                'country_id' => '1',
            ],
            [
                'name' => 'Bogura',
                'country_id' => '1',
            ],
            [
                'name' => 'Chapainawabganj',
                'country_id' => '1',
            ],
            [
                'name' => 'Joypurhat',
                'country_id' => '1',
            ],
            [
                'name' => 'Barisal',
                'country_id' => '1',
            ],
            [
                'name' => 'Barguna',
                'country_id' => '1',
            ],
            [
                'name' => 'Bhola',
                'country_id' => '1',
            ],
            [
                'name' => 'Jhalokati',
                'country_id' => '1',
            ],
            [
                'name' => 'Patuakhali',
                'country_id' => '1',
            ],
            [
                'name' => 'Pirojpur',
                'country_id' => '1',
            ],
            [
                'name' => 'Rangpur',
                'country_id' => '1',
            ],
            [
                'name' => 'Dinajpur',
                'country_id' => '1',
            ],
            [
                'name' => 'Kurigram',
                'country_id' => '1',
            ],
            [
                'name' => 'Nilphamari',
                'country_id' => '1',
            ],
            [
                'name' => 'Gaibandha',
                'country_id' => '1',
            ],
            [
                'name' => 'Thakurgaon',
                'country_id' => '1',
            ],
            [
                'name' => 'Panchagarh',
                'country_id' => '1',
            ],
            [
                'name' => 'Lalmonirhat',
                'country_id' => '1',
            ],
        ];
        foreach ($states as $state) {
            State::create($state);
        }
    }
}
