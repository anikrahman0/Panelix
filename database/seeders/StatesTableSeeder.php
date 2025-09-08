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
                'country_id' => '2',
            ],
            [
                'name' => 'Noakhali',
                'country_id' => '2',
            ],
            [
                'name' => 'Feni',
                'country_id' => '2',
            ],
            [
                'name' => 'Brahmanbaria',
                'country_id' => '2',
            ],
            [
                'name' => 'Comilla',
                'country_id' => '2',
            ],
            [
                'name' => 'Chandpur',
                'country_id' => '2',
            ],
            [
                'name' => 'Lakshmipur',
                'country_id' => '2',
            ],
            [
                'name' => 'Khagrachhari',
                'country_id' => '2',
            ],
            [
                'name' => 'Rangamati',
                'country_id' => '2',
            ],
            [
                'name' => 'Bandarban',
                'country_id' => '2',
            ],
            [
                'name' => 'Cox\'s Bazar',
                'country_id' => '2',
            ],
            [
                'name' => 'Bagerhat',
                'country_id' => '3',
            ],
            [
                'name' => 'Chuadanga',
                'country_id' => '3',
            ],
            [
                'name' => 'Jessore',
                'country_id' => '3',
            ],
            [
                'name' => 'Jhenaidah',
                'country_id' => '3',
            ],
            [
                'name' => 'Khulna',
                'country_id' => '3',
            ],
            [
                'name' => 'Kushtia',
                'country_id' => '3',
            ],
            [
                'name' => 'Magura',
                'country_id' => '3',
            ],
            [
                'name' => 'Meherpur',
                'country_id' => '3',
            ],
            [
                'name' => 'Narail',
                'country_id' => '3',
            ],
            [
                'name' => 'Satkhira',
                'country_id' => '3',
            ],
            [
                'name' => 'Habiganj',
                'country_id' => '4',
            ],
            [
                'name' => 'Moulvibazar',
                'country_id' => '4',
            ],
            [
                'name' => 'Sunamganj',
                'country_id' => '4',
            ],
            [
                'name' => 'Sylhet',
                'country_id' => '4',
            ],
            [
                'name' => 'Mymensingh',
                'country_id' => '5',
            ],
            [
                'name' => 'Netrokona',
                'country_id' => '5',
            ],
            [
                'name' => 'Jamalpur',
                'country_id' => '5',
            ],
            [
                'name' => 'Sherpur',
                'country_id' => '5',
            ],
            [
                'name' => 'Rajshahi',
                'country_id' => '6',
            ],
            [
                'name' => 'Natore',
                'country_id' => '6',
            ],
            [
                'name' => 'Naogaon',
                'country_id' => '6',
            ],
            [
                'name' => 'Sirajganj',
                'country_id' => '6',
            ],
            [
                'name' => 'Pabna',
                'country_id' => '6',
            ],
            [
                'name' => 'Bogura',
                'country_id' => '6',
            ],
            [
                'name' => 'Chapainawabganj',
                'country_id' => '6',
            ],
            [
                'name' => 'Joypurhat',
                'country_id' => '6',
            ],
            [
                'name' => 'Barisal',
                'country_id' => '7',
            ],
            [
                'name' => 'Barguna',
                'country_id' => '7',
            ],
            [
                'name' => 'Bhola',
                'country_id' => '7',
            ],
            [
                'name' => 'Jhalokati',
                'country_id' => '7',
            ],
            [
                'name' => 'Patuakhali',
                'country_id' => '7',
            ],
            [
                'name' => 'Pirojpur',
                'country_id' => '7',
            ],
            [
                'name' => 'Rangpur',
                'country_id' => '8',
            ],
            [
                'name' => 'Dinajpur',
                'country_id' => '8',
            ],
            [
                'name' => 'Kurigram',
                'country_id' => '8',
            ],
            [
                'name' => 'Nilphamari',
                'country_id' => '8',
            ],
            [
                'name' => 'Gaibandha',
                'country_id' => '8',
            ],
            [
                'name' => 'Thakurgaon',
                'country_id' => '8',
            ],
            [
                'name' => 'Panchagarh',
                'country_id' => '8',
            ],
            [
                'name' => 'Lalmonirhat',
                'country_id' => '8',
            ],
        ];
        foreach ($states as $state) {
            State::create($state);
        }
    }
}
