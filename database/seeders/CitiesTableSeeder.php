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

        City::create([
            'id' => 5,
            'name' => 'Brahmanbaria Sadar',
            'state_id' => 17,
        ]);

        City::create([
            'id' => 6,
            'name' => 'Kasba',
            'state_id' => 17,
        ]);

        City::create([
            'id' => 7,
            'name' => 'Nabinagar',
            'state_id' => 17,
        ]);

        City::create([
            'id' => 8,
            'name' => 'Nasirnagar',
            'state_id' => 17,
        ]);

        City::create([
            'id' => 9,
            'name' => 'Sarial',
            'state_id' => 17,
        ]);

        City::create([
            'id' => 10,
            'name' => 'Jaldi',
            'state_id' => 17,
        ]);

        City::create([
            'id' => 11,
            'name' => 'Bagerhat Sadar',
            'state_id' => 25,
        ]);

        City::create([
            'id' => 12,
            'name' => 'Chitalmari',
            'state_id' => 25,
        ]);

        City::create([
            'id' => 13,
            'name' => 'Fakirhat',
            'state_id' => 25,
        ]);

        City::create([
            'id' => 14,
            'name' => 'Kachua',
            'state_id' => 25,
        ]);

        City::create([
            'id' => 15,
            'name' => 'Mollahat',
            'state_id' => 25,
        ]);

        City::create([
            'id' => 16,
            'name' => 'Mongla',
            'state_id' => 25,
        ]);

        City::create([
            'id' => 17,
            'name' => 'Morrelganj',
            'state_id' => 25,
        ]);

        City::create([
            'id' => 18,
            'name' => 'Rampal',
            'state_id' => 25,
        ]);

        City::create([
            'id' => 19,
            'name' => 'Sarankhola',
            'state_id' => 25,
        ]);

        City::create([
            'id' => 20,
            'name' => 'Chalna Ankorage',
            'state_id' => 25,
        ]);

        City::create([
            'id' => 21,
            'name' => 'Sajiara',
            'state_id' => 25,
        ]);

        City::create([
            'id' => 22,
            'name' => 'Madinabad',
            'state_id' => 25,
        ]);

        City::create([
            'id' => 23,
            'name' => 'Chalna Bazar',
            'state_id' => 25,
        ]);

        City::create([
            'id' => 24,
            'name' => 'Alaipur',
            'state_id' => 25,
        ]);

        City::create([
            'id' => 25,
            'name' => 'Alikadam',
            'state_id' => 23,
        ]);

        City::create([
            'id' => 26,
            'name' => 'Bandarban Sadar',
            'state_id' => 23,
        ]);

        City::create([
            'id' => 27,
            'name' => 'Lama',
            'state_id' => 23,
        ]);

        City::create([
            'id' => 28,
            'name' => 'Naikhongchhari',
            'state_id' => 23,
        ]);

        City::create([
            'id' => 29,
            'name' => 'Roanchhari',
            'state_id' => 23,
        ]);

        City::create([
            'id' => 30,
            'name' => 'Ruma',
            'state_id' => 23,
        ]);

        City::create([
            'id' => 31,
            'name' => 'Thanchi',
            'state_id' => 23,
        ]);

        City::create([
            'id' => 32,
            'name' => 'Baishari',
            'state_id' => 23,
        ]);

        City::create([
            'id' => 33,
            'name' => 'Agailzhara',
            'state_id' => 51,
        ]);

        City::create([
            'id' => 34,
            'name' => 'Babuganj',
            'state_id' => 51,
        ]);

        City::create([
            'id' => 35,
            'name' => 'Bakerganj',
            'state_id' => 51,
        ]);

        City::create([
            'id' => 36,
            'name' => 'Banaripara',
            'state_id' => 51,
        ]);

        City::create([
            'id' => 37,
            'name' => 'Barishal Sadar',
            'state_id' => 51,
        ]);

        City::create([
            'id' => 38,
            'name' => 'Gouranadi',
            'state_id' => 51,
        ]);

        City::create([
            'id' => 39,
            'name' => 'Hizla',
            'state_id' => 51,
        ]);

        City::create([
            'id' => 40,
            'name' => 'Mehendiganj',
            'state_id' => 51,
        ]);

        City::create([
            'id' => 41,
            'name' => 'Muladi',
            'state_id' => 51,
        ]);

        City::create([
            'id' => 42,
            'name' => 'Uzirpur',
            'state_id' => 51,
        ]);

        City::create([
            'id' => 43,
            'name' => 'Barajalia',
            'state_id' => 51,
        ]);

        City::create([
            'id' => 44,
            'name' => 'Sahebganj',
            'state_id' => 51,
        ]);

        City::create([
            'id' => 45,
            'name' => 'Kajir Hat',
            'state_id' => 51,
        ]);

        City::create([
            'id' => 46,
            'name' => 'Kawnia',
            'state_id' => 51,
        ]);

        City::create([
            'id' => 47,
            'name' => 'Bhola Sadar',
            'state_id' => 53,
        ]);

        City::create([
            'id' => 48,
            'name' => 'Burhanuddin',
            'state_id' => 53,
        ]);

        City::create([
            'id' => 49,
            'name' => 'Char Fasson',
            'state_id' => 53,
        ]);

        City::create([
            'id' => 50,
            'name' => 'Daulatkhan',
            'state_id' => 53,
        ]);

        City::create([
            'id' => 51,
            'name' => 'Lalmohan',
            'state_id' => 53,
        ]);

        City::create([
            'id' => 52,
            'name' => 'Manpura',
            'state_id' => 53,
        ]);

        City::create([
            'id' => 53,
            'name' => 'Tazumuddin',
            'state_id' => 53,
        ]);

        City::create([
            'id' => 54,
            'name' => 'Hajirhat',
            'state_id' => 53,
        ]);

        City::create([
            'id' => 55,
            'name' => 'Hatshoshiganj',
            'state_id' => 53,
        ]);

        City::create([
            'id' => 56,
            'name' => 'Dakshinaicha',
            'state_id' => 53,
        ]);

        City::create([
            'id' => 57,
            'name' => 'Shasibussion',
            'state_id' => 53,
        ]);

        City::create([
            'id' => 58,
            'name' => 'Adamdighi',
            'state_id' => 48,
        ]);

        City::create([
            'id' => 59,
            'name' => 'Bogura Sadar',
            'state_id' => 48,
        ]);

        City::create([
            'id' => 60,
            'name' => 'Dhunat',
            'state_id' => 48,
        ]);

        City::create([
            'id' => 61,
            'name' => 'Dupchanchia',
            'state_id' => 48,
        ]);

        City::create([
            'id' => 62,
            'name' => 'Gabtoli',
            'state_id' => 48,
        ]);

        City::create([
            'id' => 63,
            'name' => 'Kahalu',
            'state_id' => 48,
        ]);

        City::create([
            'id' => 64,
            'name' => 'Nandigram',
            'state_id' => 48,
        ]);

        City::create([
            'id' => 65,
            'name' => 'Sariakandi',
            'state_id' => 48,
        ]);

        City::create([
            'id' => 66,
            'name' => 'Shajahanpur',
            'state_id' => 48,
        ]);

        City::create([
            'id' => 67,
            'name' => 'Sherpur',
            'state_id' => 48,
        ]);

        City::create([
            'id' => 68,
            'name' => 'Shibganj',
            'state_id' => 48,
        ]);

        City::create([
            'id' => 69,
            'name' => 'Sonatola',
            'state_id' => 48,
        ]);

        City::create([
            'id' => 70,
            'name' => 'Tanor',
            'state_id' => 48,
        ]);

        City::create([
            'id' => 71,
            'name' => 'Lalitganj',
            'state_id' => 48,
        ]);

        City::create([
            'id' => 72,
            'name' => 'Khodmohanpur',
            'state_id' => 48,
        ]);

        City::create([
            'id' => 73,
            'name' => 'Bhabaniganj',
            'state_id' => 48,
        ]);

        City::create([
            'id' => 74,
            'name' => 'Amtali',
            'state_id' => 52,
        ]);

        City::create([
            'id' => 75,
            'name' => 'Bamna',
            'state_id' => 52,
        ]);

        City::create([
            'id' => 76,
            'name' => 'Barguna Sadar',
            'state_id' => 52,
        ]);

        City::create([
            'id' => 77,
            'name' => 'Betagi',
            'state_id' => 52,
        ]);

        City::create([
            'id' => 78,
            'name' => 'Patharghata',
            'state_id' => 52,
        ]);

        City::create([
            'id' => 79,
            'name' => 'Taltoli',
            'state_id' => 52,
        ]);

        City::create([
            'id' => 80,
            'name' => 'Taltali',
            'state_id' => 52,
        ]);

        City::create([
            'id' => 81,
            'name' => 'Chandpur Sadar',
            'state_id' => 19,
        ]);

        City::create([
            'id' => 82,
            'name' => 'Faridganj',
            'state_id' => 19,
        ]);

        City::create([
            'id' => 83,
            'name' => 'Hayemchar',
            'state_id' => 19,
        ]);

        City::create([
            'id' => 84,
            'name' => 'Hajiganj',
            'state_id' => 19,
        ]);

        City::create([
            'id' => 85,
            'name' => 'Kachua',
            'state_id' => 19,
        ]);

        City::create([
            'id' => 86,
            'name' => 'Matlab Dakshin',
            'state_id' => 19,
        ]);

        City::create([
            'id' => 87,
            'name' => 'Matlab Uttar',
            'state_id' => 19,
        ]);

        City::create([
            'id' => 88,
            'name' => 'Shahrasti',
            'state_id' => 19,
        ]);

        City::create([
            'id' => 89,
            'name' => 'Bholahat',
            'state_id' => 49,
        ]);

        City::create([
            'id' => 90,
            'name' => 'Gomashtapur',
            'state_id' => 49,
        ]);

        City::create([
            'id' => 91,
            'name' => 'Nachole',
            'state_id' => 49,
        ]);

        City::create([
            'id' => 92,
            'name' => 'Nawabganj Sadar',
            'state_id' => 49,
        ]);

        City::create([
            'id' => 93,
            'name' => 'Shibganj',
            'state_id' => 49,
        ]);

        City::create([
            'id' => 94,
            'name' => 'Rohanpur',
            'state_id' => 49,
        ]);

        City::create([
            'id' => 95,
            'name' => 'Chapainawabganj Sadar',
            'state_id' => 49,
        ]);

        City::create([
            'id' => 96,
            'name' => 'Anwara',
            'state_id' => 14,
        ]);

        City::create([
            'id' => 97,
            'name' => 'Bandar',
            'state_id' => 14,
        ]);

        City::create([
            'id' => 98,
            'name' => 'Banshkhali',
            'state_id' => 14,
        ]);

        City::create([
            'id' => 99,
            'name' => 'Boalkhali',
            'state_id' => 14,
        ]);

        City::create([
            'id' => 100,
            'name' => 'Chandanaish',
            'state_id' => 14,
        ]);

        City::create([
            'id' => 101,
            'name' => 'Chandgaon',
            'state_id' => 14,
        ]);

        City::create([
            'id' => 102,
            'name' => 'Double Mooring',
            'state_id' => 14,
        ]);

        City::create([
            'id' => 103,
            'name' => 'Fatikchhari',
            'state_id' => 14,
        ]);

        City::create([
            'id' => 104,
            'name' => 'Hathazari',
            'state_id' => 14,
        ]);

        City::create([
            'id' => 105,
            'name' => 'Kotwali',
            'state_id' => 14,
        ]);

        City::create([
            'id' => 106,
            'name' => 'Lohagara',
            'state_id' => 14,
        ]);

        City::create([
            'id' => 107,
            'name' => 'Mirsharai',
            'state_id' => 14,
        ]);

        City::create([
            'id' => 108,
            'name' => 'Pahartali',
            'state_id' => 14,
        ]);

        City::create([
            'id' => 109,
            'name' => 'Panchlaish',
            'state_id' => 14,
        ]);

        City::create([
            'id' => 110,
            'name' => 'Patiya',
            'state_id' => 14,
        ]);

        City::create([
            'id' => 111,
            'name' => 'Rangunia',
            'state_id' => 14,
        ]);

        City::create([
            'id' => 112,
            'name' => 'Rouzan',
            'state_id' => 14,
        ]);

        City::create([
            'id' => 113,
            'name' => 'Sandwip',
            'state_id' => 14,
        ]);

        City::create([
            'id' => 114,
            'name' => 'Satkania',
            'state_id' => 14,
        ]);

        City::create([
            'id' => 115,
            'name' => 'Sitakunda',
            'state_id' => 14,
        ]);

        City::create([
            'id' => 116,
            'name' => 'Karnaphuli ',
            'state_id' => 14,
        ]);

        City::create([
            'id' => 117,
            'name' => 'Bhujpur',
            'state_id' => 14,
        ]);

        City::create([
            'id' => 118,
            'name' => 'Chattogram Sadar',
            'state_id' => 14,
        ]);

        City::create([
            'id' => 119,
            'name' => 'Bayazid Bostami',
            'state_id' => 14,
        ]);

        City::create([
            'id' => 120,
            'name' => 'Chittagong Epz',
            'state_id' => 14,
        ]);

        City::create([
            'id' => 121,
            'name' => 'Joraganj',
            'state_id' => 14,
        ]);

        City::create([
            'id' => 122,
            'name' => 'Khulshi',
            'state_id' => 14,
        ]);

        City::create([
            'id' => 123,
            'name' => 'Sadarghat',
            'state_id' => 14,
        ]);

        City::create([
            'id' => 124,
            'name' => 'East Joara',
            'state_id' => 14,
        ]);

        City::create([
            'id' => 125,
            'name' => 'Halishahar',
            'state_id' => 14,
        ]);

        City::create([
            'id' => 126,
            'name' => 'Bakalia',
            'state_id' => 14,
        ]);

        City::create([
            'id' => 127,
            'name' => 'Patenga',
            'state_id' => 14,
        ]);

        City::create([
            'id' => 128,
            'name' => 'Alamdanga',
            'state_id' => 26,
        ]);

        City::create([
            'id' => 129,
            'name' => 'Chuadanga Sadar',
            'state_id' => 26,
        ]);

        City::create([
            'id' => 130,
            'name' => 'Chuadanga Sadar',
            'state_id' => 26,
        ]);

        City::create([
            'id' => 131,
            'name' => 'Jibannagar',
            'state_id' => 26,
        ]);

        City::create([
            'id' => 132,
            'name' => 'Jiban Nagar',
            'state_id' => 26,
        ]);

        City::create([
            'id' => 133,
            'name' => 'Doulatganj',
            'state_id' => 26,
        ]);

        City::create([
            'id' => 134,
            'name' => 'Barura',
            'state_id' => 18,
        ]);

        City::create([
            'id' => 135,
            'name' => 'Brahmanpara',
            'state_id' => 18,
        ]);

        City::create([
            'id' => 136,
            'name' => 'Burichang',
            'state_id' => 18,
        ]);

        City::create([
            'id' => 137,
            'name' => 'Chandina',
            'state_id' => 18,
        ]);

        City::create([
            'id' => 138,
            'name' => 'Chauddagram',
            'state_id' => 18,
        ]);

        City::create([
            'id' => 139,
            'name' => 'Cumilla Adarsha Sadar',
            'state_id' => 18,
        ]);

        City::create([
            'id' => 140,
            'name' => 'Cumilla Sadar Dakshin',
            'state_id' => 18,
        ]);

        City::create([
            'id' => 141,
            'name' => 'Daudkandi',
            'state_id' => 18,
        ]);

        City::create([
            'id' => 142,
            'name' => 'Debidwar',
            'state_id' => 18,
        ]);

        City::create([
            'id' => 143,
            'name' => 'Homna',
            'state_id' => 18,
        ]);

        City::create([
            'id' => 144,
            'name' => 'Laksam',
            'state_id' => 18,
        ]);

        City::create([
            'id' => 145,
            'name' => 'Meghna',
            'state_id' => 18,
        ]);

        City::create([
            'id' => 146,
            'name' => 'Monohargonj',
            'state_id' => 18,
        ]);

        City::create([
            'id' => 147,
            'name' => 'Muradnagar',
            'state_id' => 18,
        ]);

        City::create([
            'id' => 148,
            'name' => 'Nangalkot',
            'state_id' => 18,
        ]);

        City::create([
            'id' => 149,
            'name' => 'Titas',
            'state_id' => 18,
        ]);

        City::create([
            'id' => 150,
            'name' => 'Bangora Bazar',
            'state_id' => 18,
        ]);

        City::create([
            'id' => 151,
            'name' => 'Manoharganj',
            'state_id' => 18,
        ]);

        City::create([
            'id' => 152,
            'name' => 'Lalmai',
            'state_id' => 18,
        ]);

        City::create([
            'id' => 153,
            'name' => 'Chakaria',
            'state_id' => 24,
        ]);

        City::create([
            'id' => 154,
            'name' => 'Cox\'s Bazar Sadar',
            'state_id' => 24,
        ]);

        City::create([
            'id' => 155,
            'name' => 'Kutubdia',
            'state_id' => 24,
        ]);

        City::create([
            'id' => 156,
            'name' => 'Maheshkhali',
            'state_id' => 24,
        ]);

        City::create([
            'id' => 157,
            'name' => 'Pekua',
            'state_id' => 24,
        ]);

        City::create([
            'id' => 158,
            'name' => 'Ramu',
            'state_id' => 24,
        ]);

        City::create([
            'id' => 159,
            'name' => 'Teknaf',
            'state_id' => 24,
        ]);

        City::create([
            'id' => 160,
            'name' => 'Ukhia',
            'state_id' => 24,
        ]);

        City::create([
            'id' => 161,
            'name' => 'Gorakghat',
            'state_id' => 24,
        ]);

        City::create([
            'id' => 162,
            'name' => 'Chiringga',
            'state_id' => 24,
        ]);

        City::create([
            'id' => 163,
            'name' => 'Adabor',
            'state_id' => 1,
        ]);

        City::create([
            'id' => 164,
            'name' => 'Badda',
            'state_id' => 1,
        ]);

        City::create([
            'id' => 165,
            'name' => 'Bangsal',
            'state_id' => 1,
        ]);

        City::create([
            'id' => 166,
            'name' => 'Bimanbandar',
            'state_id' => 1,
        ]);

        City::create([
            'id' => 167,
            'name' => 'Cantonment',
            'state_id' => 1,
        ]);

        City::create([
            'id' => 168,
            'name' => 'Chak Bazar',
            'state_id' => 1,
        ]);

        City::create([
            'id' => 169,
            'name' => 'Dakshinkhan',
            'state_id' => 1,
        ]);

        City::create([
            'id' => 170,
            'name' => 'Darus Salam',
            'state_id' => 1,
        ]);

        City::create([
            'id' => 171,
            'name' => 'Demra',
            'state_id' => 1,
        ]);

        City::create([
            'id' => 172,
            'name' => 'Dhamrai',
            'state_id' => 1,
        ]);

        City::create([
            'id' => 173,
            'name' => 'Dhanmondi',
            'state_id' => 1,
        ]);

        City::create([
            'id' => 174,
            'name' => 'Dohar.',
            'state_id' => 1,
        ]);

        City::create([
            'id' => 175,
            'name' => 'Gendaria',
            'state_id' => 1,
        ]);

        City::create([
            'id' => 176,
            'name' => 'Gulshan',
            'state_id' => 1,
        ]);

        City::create([
            'id' => 177,
            'name' => 'Hazaribagh',
            'state_id' => 1,
        ]);

        City::create([
            'id' => 178,
            'name' => 'Jatrabari',
            'state_id' => 1,
        ]);

        City::create([
            'id' => 179,
            'name' => 'Kadamtali',
            'state_id' => 1,
        ]);

        City::create([
            'id' => 180,
            'name' => 'Kafrul',
            'state_id' => 1,
        ]);

        City::create([
            'id' => 181,
            'name' => 'Kalabagan',
            'state_id' => 1,
        ]);

        City::create([
            'id' => 182,
            'name' => 'Kamrangirchar',
            'state_id' => 1,
        ]);

        City::create([
            'id' => 183,
            'name' => 'Keraniganj',
            'state_id' => 1,
        ]);

        City::create([
            'id' => 184,
            'name' => 'Khilgaon',
            'state_id' => 1,
        ]);

        City::create([
            'id' => 185,
            'name' => 'Khilkhet',
            'state_id' => 1,
        ]);

        City::create([
            'id' => 186,
            'name' => 'Kotwali',
            'state_id' => 1,
        ]);

        City::create([
            'id' => 187,
            'name' => 'Lalbagh',
            'state_id' => 1,
        ]);

        City::create([
            'id' => 188,
            'name' => 'Mirpur',
            'state_id' => 1,
        ]);

        City::create([
            'id' => 189,
            'name' => 'Mohakhali',
            'state_id' => 1,
        ]);

        City::create([
            'id' => 190,
            'name' => 'Mohammadpur',
            'state_id' => 1,
        ]);

        City::create([
            'id' => 191,
            'name' => 'Motijheel',
            'state_id' => 1,
        ]);

        City::create([
            'id' => 192,
            'name' => 'Nawabganj',
            'state_id' => 1,
        ]);

        City::create([
            'id' => 193,
            'name' => 'Natun Bazar',
            'state_id' => 1,
        ]);

        City::create([
            'id' => 194,
            'name' => 'Pallabi',
            'state_id' => 1,
        ]);

        City::create([
            'id' => 195,
            'name' => 'Paltan',
            'state_id' => 1,
        ]);

        City::create([
            'id' => 196,
            'name' => 'Ramna',
            'state_id' => 1,
        ]);

        City::create([
            'id' => 197,
            'name' => 'Rampura',
            'state_id' => 1,
        ]);

        City::create([
            'id' => 198,
            'name' => 'Sabujbagh',
            'state_id' => 1,
        ]);

        City::create([
            'id' => 199,
            'name' => 'Savar',
            'state_id' => 1,
        ]);

        City::create([
            'id' => 200,
            'name' => 'Shah Ali',
            'state_id' => 1,
        ]);

        City::create([
            'id' => 201,
            'name' => 'Shahbag',
            'state_id' => 1,
        ]);

        City::create([
            'id' => 202,
            'name' => 'Sher-e-Bangla Nagar',
            'state_id' => 1,
        ]);

        City::create([
            'id' => 203,
            'name' => 'Shyampur',
            'state_id' => 1,
        ]);

        City::create([
            'id' => 204,
            'name' => 'Sutrapur',
            'state_id' => 1,
        ]);

        City::create([
            'id' => 205,
            'name' => 'Tejgaon',
            'state_id' => 1,
        ]);

        City::create([
            'id' => 206,
            'name' => 'Tejgaon Industrial Area',
            'state_id' => 1,
        ]);

        City::create([
            'id' => 207,
            'name' => 'Turag',
            'state_id' => 1,
        ]);

        City::create([
            'id' => 208,
            'name' => 'Uttar Khan',
            'state_id' => 1,
        ]);

        City::create([
            'id' => 209,
            'name' => 'Uttara',
            'state_id' => 1,
        ]);

        City::create([
            'id' => 210,
            'name' => 'Joypara',
            'state_id' => 1,
        ]);

        City::create([
            'id' => 211,
            'name' => 'Ashulia',
            'state_id' => 1,
        ]);

        City::create([
            'id' => 212,
            'name' => 'Rupnagar',
            'state_id' => 1,
        ]);

        City::create([
            'id' => 213,
            'name' => 'Shahjahanpur',
            'state_id' => 1,
        ]);

        City::create([
            'id' => 214,
            'name' => 'Shahjalal Airport',
            'state_id' => 1,
        ]);

        City::create([
            'id' => 215,
            'name' => 'Uttara East',
            'state_id' => 1,
        ]);

        City::create([
            'id' => 216,
            'name' => 'Uttara West',
            'state_id' => 1,
        ]);

        City::create([
            'id' => 217,
            'name' => 'Vatara',
            'state_id' => 1,
        ]);

        City::create([
            'id' => 218,
            'name' => 'Wari',
            'state_id' => 1,
        ]);

        City::create([
            'id' => 219,
            'name' => 'Dakshin Khan',
            'state_id' => 1,
        ]);

        City::create([
            'id' => 220,
            'name' => 'Dhaka Railway',
            'state_id' => 1,
        ]);

        City::create([
            'id' => 221,
            'name' => 'Mugda',
            'state_id' => 1,
        ]);

        City::create([
            'id' => 222,
            'name' => 'New Market',
            'state_id' => 1,
        ]);

        City::create([
            'id' => 223,
            'name' => 'South Keraniganj',
            'state_id' => 1,
        ]);

        City::create([
            'id' => 224,
            'name' => 'Bhashantek',
            'state_id' => 1,
        ]);

        City::create([
            'id' => 225,
            'name' => 'New Market TSO',
            'state_id' => 1,
        ]);

        City::create([
            'id' => 226,
            'name' => 'Shantinagar',
            'state_id' => 1,
        ]);

        City::create([
            'id' => 227,
            'name' => 'Banani',
            'state_id' => 1,
        ]);

        City::create([
            'id' => 228,
            'name' => 'Mugdapara',
            'state_id' => 1,
        ]);

        City::create([
            'id' => 229,
            'name' => 'Shankar',
            'state_id' => 1,
        ]);

        City::create([
            'id' => 230,
            'name' => 'Kawran Bazar',
            'state_id' => 1,
        ]);

        City::create([
            'id' => 231,
            'name' => 'Banglamotor',
            'state_id' => 1,
        ]);

        City::create([
            'id' => 232,
            'name' => 'Kakrail',
            'state_id' => 1,
        ]);

        City::create([
            'id' => 233,
            'name' => 'Biral',
            'state_id' => 58,
        ]);

        City::create([
            'id' => 234,
            'name' => 'Birampur',
            'state_id' => 58,
        ]);

        City::create([
            'id' => 235,
            'name' => 'Birganj',
            'state_id' => 58,
        ]);

        City::create([
            'id' => 236,
            'name' => 'Bochaganj',
            'state_id' => 58,
        ]);

        City::create([
            'id' => 237,
            'name' => 'Chirirbandar',
            'state_id' => 58,
        ]);

        City::create([
            'id' => 238,
            'name' => 'Dinajpur Sadar',
            'state_id' => 58,
        ]);

        City::create([
            'id' => 239,
            'name' => 'Ghoraghat',
            'state_id' => 58,
        ]);

        City::create([
            'id' => 240,
            'name' => 'Hakimpur',
            'state_id' => 58,
        ]);

        City::create([
            'id' => 241,
            'name' => 'Kaharole',
            'state_id' => 58,
        ]);

        City::create([
            'id' => 242,
            'name' => 'Khansama',
            'state_id' => 58,
        ]);

        City::create([
            'id' => 243,
            'name' => 'Nawabganj',
            'state_id' => 58,
        ]);

        City::create([
            'id' => 244,
            'name' => 'Parbatipur',
            'state_id' => 58,
        ]);

        City::create([
            'id' => 245,
            'name' => 'Phulbari',
            'state_id' => 58,
        ]);

        City::create([
            'id' => 246,
            'name' => 'Setabganj',
            'state_id' => 58,
        ]);

        City::create([
            'id' => 247,
            'name' => 'Osmanpur',
            'state_id' => 58,
        ]);

        City::create([
            'id' => 248,
            'name' => 'Maharajganj',
            'state_id' => 58,
        ]);

        City::create([
            'id' => 249,
            'name' => 'Bangla Hili',
            'state_id' => 58,
        ]);

        City::create([
            'id' => 250,
            'name' => 'Alfadanga',
            'state_id' => 9,
        ]);

        City::create([
            'id' => 251,
            'name' => 'Bhanga',
            'state_id' => 9,
        ]);

        City::create([
            'id' => 252,
            'name' => 'Boalmari',
            'state_id' => 9,
        ]);

        City::create([
            'id' => 253,
            'name' => 'Charbhadrasan ',
            'state_id' => 9,
        ]);

        City::create([
            'id' => 254,
            'name' => 'Faridpur Sadar',
            'state_id' => 9,
        ]);

        City::create([
            'id' => 255,
            'name' => 'Madhukhali',
            'state_id' => 9,
        ]);

        City::create([
            'id' => 256,
            'name' => 'Nagarkanda',
            'state_id' => 9,
        ]);

        City::create([
            'id' => 257,
            'name' => 'Sadarpur',
            'state_id' => 9,
        ]);

        City::create([
            'id' => 258,
            'name' => 'Saltha',
            'state_id' => 9,
        ]);

        City::create([
            'id' => 259,
            'name' => 'Sundarpur',
            'state_id' => 9,
        ]);

        City::create([
            'id' => 260,
            'name' => 'Shriangan',
            'state_id' => 9,
        ]);

        City::create([
            'id' => 261,
            'name' => 'Chhagalnaiya',
            'state_id' => 16,
        ]);

        City::create([
            'id' => 262,
            'name' => 'Daganbhuiyan',
            'state_id' => 16,
        ]);

        City::create([
            'id' => 263,
            'name' => 'Feni Sadar',
            'state_id' => 16,
        ]);

        City::create([
            'id' => 264,
            'name' => 'Fulgazi',
            'state_id' => 16,
        ]);

        City::create([
            'id' => 265,
            'name' => 'Parshuram',
            'state_id' => 16,
        ]);

        City::create([
            'id' => 266,
            'name' => 'Sonagazi',
            'state_id' => 16,
        ]);

        City::create([
            'id' => 267,
            'name' => 'Gaibandha Sadar',
            'state_id' => 61,
        ]);

        City::create([
            'id' => 268,
            'name' => 'Gobindaganj',
            'state_id' => 61,
        ]);

        City::create([
            'id' => 269,
            'name' => 'Palashbari',
            'state_id' => 61,
        ]);

        City::create([
            'id' => 270,
            'name' => 'Phulchhari',
            'state_id' => 61,
        ]);

        City::create([
            'id' => 271,
            'name' => 'Saadullapur',
            'state_id' => 61,
        ]);

        City::create([
            'id' => 272,
            'name' => 'Sughatta',
            'state_id' => 61,
        ]);

        City::create([
            'id' => 273,
            'name' => 'Sundarganj',
            'state_id' => 61,
        ]);

        City::create([
            'id' => 274,
            'name' => 'Bonarpara',
            'state_id' => 61,
        ]);

        City::create([
            'id' => 275,
            'name' => 'Gazipur Sadar',
            'state_id' => 2,
        ]);

        City::create([
            'id' => 276,
            'name' => 'Kaliakair',
            'state_id' => 2,
        ]);

        City::create([
            'id' => 277,
            'name' => 'Kaliganj',
            'state_id' => 2,
        ]);

        City::create([
            'id' => 278,
            'name' => 'Kapasia',
            'state_id' => 2,
        ]);

        City::create([
            'id' => 279,
            'name' => 'Sreepur',
            'state_id' => 2,
        ]);

        City::create([
            'id' => 280,
            'name' => 'Tongi',
            'state_id' => 2,
        ]);

        City::create([
            'id' => 281,
            'name' => 'Monnunagar',
            'state_id' => 2,
        ]);

        City::create([
            'id' => 282,
            'name' => 'Ostagram',
            'state_id' => 2,
        ]);

        City::create([
            'id' => 283,
            'name' => 'Kashimpur',
            'state_id' => 2,
        ]);

        City::create([
            'id' => 284,
            'name' => 'Gopalganj Sadar',
            'state_id' => 10,
        ]);

        City::create([
            'id' => 285,
            'name' => 'Kashiani',
            'state_id' => 10,
        ]);

        City::create([
            'id' => 286,
            'name' => 'Kotalipara',
            'state_id' => 10,
        ]);

        City::create([
            'id' => 287,
            'name' => 'Muksudpur',
            'state_id' => 10,
        ]);

        City::create([
            'id' => 288,
            'name' => 'Tungipara',
            'state_id' => 10,
        ]);

        City::create([
            'id' => 289,
            'name' => 'Joydebpur',
            'state_id' => 10,
        ]);

        City::create([
            'id' => 290,
            'name' => 'Azmireeganj ',
            'state_id' => 35,
        ]);

        City::create([
            'id' => 291,
            'name' => 'Bahubal',
            'state_id' => 35,
        ]);

        City::create([
            'id' => 292,
            'name' => 'Baniachong',
            'state_id' => 35,
        ]);

        City::create([
            'id' => 293,
            'name' => 'Chunarughat',
            'state_id' => 35,
        ]);

        City::create([
            'id' => 294,
            'name' => 'Habiganj Sadar',
            'state_id' => 35,
        ]);

        City::create([
            'id' => 295,
            'name' => 'Lakhai',
            'state_id' => 35,
        ]);

        City::create([
            'id' => 296,
            'name' => 'Madhabpur',
            'state_id' => 35,
        ]);

        City::create([
            'id' => 297,
            'name' => 'Nabiganj',
            'state_id' => 35,
        ]);

        City::create([
            'id' => 298,
            'name' => 'Shayestaganj',
            'state_id' => 35,
        ]);

        City::create([
            'id' => 299,
            'name' => 'Kalauk',
            'state_id' => 35,
        ]);

        City::create([
            'id' => 300,
            'name' => 'Bakshiganj',
            'state_id' => 41,
        ]);

        City::create([
            'id' => 301,
            'name' => 'Dewanganj',
            'state_id' => 41,
        ]);

        City::create([
            'id' => 302,
            'name' => 'Islampur',
            'state_id' => 41,
        ]);

        City::create([
            'id' => 303,
            'name' => 'Jamalpur Sadar',
            'state_id' => 41,
        ]);

        City::create([
            'id' => 304,
            'name' => 'Madarganj',
            'state_id' => 41,
        ]);

        City::create([
            'id' => 305,
            'name' => 'Melandaha',
            'state_id' => 41,
        ]);

        City::create([
            'id' => 306,
            'name' => 'Sarishabari',
            'state_id' => 41,
        ]);

        City::create([
            'id' => 307,
            'name' => 'River Thana Bahadurabad',
            'state_id' => 41,
        ]);

        City::create([
            'id' => 308,
            'name' => 'Abhaynagar',
            'state_id' => 27,
        ]);

        City::create([
            'id' => 309,
            'name' => 'Bagherpara',
            'state_id' => 27,
        ]);

        City::create([
            'id' => 310,
            'name' => 'Chaugachha',
            'state_id' => 27,
        ]);

        City::create([
            'id' => 311,
            'name' => 'Jashore Sadar',
            'state_id' => 27,
        ]);

        City::create([
            'id' => 312,
            'name' => 'Jhikargachha',
            'state_id' => 27,
        ]);

        City::create([
            'id' => 313,
            'name' => 'Keshabpur',
            'state_id' => 27,
        ]);

        City::create([
            'id' => 314,
            'name' => 'Manirampur',
            'state_id' => 27,
        ]);

        City::create([
            'id' => 315,
            'name' => 'Sharsha',
            'state_id' => 27,
        ]);

        City::create([
            'id' => 316,
            'name' => 'Jhalokati Sadar',
            'state_id' => 54,
        ]);

        City::create([
            'id' => 317,
            'name' => 'Kathalia',
            'state_id' => 54,
        ]);

        City::create([
            'id' => 318,
            'name' => 'Nalchhiti',
            'state_id' => 54,
        ]);

        City::create([
            'id' => 319,
            'name' => 'Rajapur',
            'state_id' => 54,
        ]);

        City::create([
            'id' => 320,
            'name' => 'Harinakundu',
            'state_id' => 28,
        ]);

        City::create([
            'id' => 321,
            'name' => 'Jhenaidah Sadar',
            'state_id' => 28,
        ]);

        City::create([
            'id' => 322,
            'name' => 'Kaliganj',
            'state_id' => 28,
        ]);

        City::create([
            'id' => 323,
            'name' => 'Kotchandpur',
            'state_id' => 28,
        ]);

        City::create([
            'id' => 324,
            'name' => 'Maheshpur',
            'state_id' => 28,
        ]);

        City::create([
            'id' => 325,
            'name' => 'Shailkupa',
            'state_id' => 28,
        ]);

        City::create([
            'id' => 326,
            'name' => 'Benapole Port',
            'state_id' => 28,
        ]);

        City::create([
            'id' => 327,
            'name' => 'Akkelpur',
            'state_id' => 50,
        ]);

        City::create([
            'id' => 328,
            'name' => 'Joypurhat Sadar',
            'state_id' => 50,
        ]);

        City::create([
            'id' => 329,
            'name' => 'Kalai',
            'state_id' => 50,
        ]);

        City::create([
            'id' => 330,
            'name' => 'Khetlal',
            'state_id' => 50,
        ]);

        City::create([
            'id' => 331,
            'name' => 'Panchbibi',
            'state_id' => 50,
        ]);

        City::create([
            'id' => 332,
            'name' => 'Dighinala',
            'state_id' => 21,
        ]);

        City::create([
            'id' => 333,
            'name' => 'Khagrachhari',
            'state_id' => 21,
        ]);

        City::create([
            'id' => 334,
            'name' => 'Lakshmichhari',
            'state_id' => 21,
        ]);

        City::create([
            'id' => 335,
            'name' => 'Mahalchhari',
            'state_id' => 21,
        ]);

        City::create([
            'id' => 336,
            'name' => 'Manikchhari',
            'state_id' => 21,
        ]);

        City::create([
            'id' => 337,
            'name' => 'Matiranga',
            'state_id' => 21,
        ]);

        City::create([
            'id' => 338,
            'name' => 'Panchhari',
            'state_id' => 21,
        ]);

        City::create([
            'id' => 339,
            'name' => 'Ramgarh',
            'state_id' => 21,
        ]);

        City::create([
            'id' => 340,
            'name' => 'Guimara',
            'state_id' => 21,
        ]);

        City::create([
            'id' => 341,
            'name' => 'Khagrachhari Sadar',
            'state_id' => 21,
        ]);

        City::create([
            'id' => 342,
            'name' => 'Batiaghata',
            'state_id' => 29,
        ]);

        City::create([
            'id' => 343,
            'name' => 'Dacope',
            'state_id' => 29,
        ]);

        City::create([
            'id' => 344,
            'name' => 'Daulatpur',
            'state_id' => 29,
        ]);

        City::create([
            'id' => 345,
            'name' => 'Dighalia',
            'state_id' => 29,
        ]);

        City::create([
            'id' => 346,
            'name' => 'Dumuria',
            'state_id' => 29,
        ]);

        City::create([
            'id' => 347,
            'name' => 'Harintana',
            'state_id' => 29,
        ]);

        City::create([
            'id' => 348,
            'name' => 'Khalishpur',
            'state_id' => 29,
        ]);

        City::create([
            'id' => 349,
            'name' => 'Khan Jahan Ali',
            'state_id' => 29,
        ]);

        City::create([
            'id' => 350,
            'name' => 'Kotwali',
            'state_id' => 29,
        ]);

        City::create([
            'id' => 351,
            'name' => 'Koyra',
            'state_id' => 29,
        ]);

        City::create([
            'id' => 352,
            'name' => 'Paikgachha',
            'state_id' => 29,
        ]);

        City::create([
            'id' => 353,
            'name' => 'Phultala',
            'state_id' => 29,
        ]);

        City::create([
            'id' => 354,
            'name' => 'Rupsha',
            'state_id' => 29,
        ]);

        City::create([
            'id' => 355,
            'name' => 'Sonadanga',
            'state_id' => 29,
        ]);

        City::create([
            'id' => 356,
            'name' => 'Terokhada',
            'state_id' => 29,
        ]);

        City::create([
            'id' => 357,
            'name' => 'Khulna Sadar',
            'state_id' => 29,
        ]);

        City::create([
            'id' => 358,
            'name' => 'Aronghata',
            'state_id' => 29,
        ]);

        City::create([
            'id' => 359,
            'name' => 'Labanchora',
            'state_id' => 29,
        ]);

        City::create([
            'id' => 360,
            'name' => 'Astagram',
            'state_id' => 3,
        ]);

        City::create([
            'id' => 361,
            'name' => 'Bajitpur',
            'state_id' => 3,
        ]);

        City::create([
            'id' => 362,
            'name' => 'Bhairab',
            'state_id' => 3,
        ]);

        City::create([
            'id' => 363,
            'name' => 'Hossainpur',
            'state_id' => 3,
        ]);

        City::create([
            'id' => 364,
            'name' => 'Itna',
            'state_id' => 3,
        ]);

        City::create([
            'id' => 365,
            'name' => 'Karimganj',
            'state_id' => 3,
        ]);

        City::create([
            'id' => 366,
            'name' => 'Katiadi',
            'state_id' => 3,
        ]);

        City::create([
            'id' => 367,
            'name' => 'Kishoreganj Sadar',
            'state_id' => 3,
        ]);

        City::create([
            'id' => 368,
            'name' => 'Kuliarchar',
            'state_id' => 3,
        ]);

        City::create([
            'id' => 369,
            'name' => 'Mithamain',
            'state_id' => 3,
        ]);

        City::create([
            'id' => 370,
            'name' => 'Nikli',
            'state_id' => 3,
        ]);

        City::create([
            'id' => 371,
            'name' => 'Pakundia',
            'state_id' => 3,
        ]);

        City::create([
            'id' => 372,
            'name' => 'Tarail',
            'state_id' => 3,
        ]);

        City::create([
            'id' => 373,
            'name' => 'Bhurungamari',
            'state_id' => 59,
        ]);

        City::create([
            'id' => 374,
            'name' => 'Char Rajibpur',
            'state_id' => 59,
        ]);

        City::create([
            'id' => 375,
            'name' => 'Chilmari',
            'state_id' => 59,
        ]);

        City::create([
            'id' => 376,
            'name' => 'Kurigram Sadar',
            'state_id' => 59,
        ]);

        City::create([
            'id' => 377,
            'name' => 'Nageshwari',
            'state_id' => 59,
        ]);

        City::create([
            'id' => 378,
            'name' => 'Phulbari',
            'state_id' => 59,
        ]);

        City::create([
            'id' => 379,
            'name' => 'Rajarhat',
            'state_id' => 59,
        ]);

        City::create([
            'id' => 380,
            'name' => 'Roumari',
            'state_id' => 59,
        ]);

        City::create([
            'id' => 381,
            'name' => 'Ulipur',
            'state_id' => 59,
        ]);

        City::create([
            'id' => 382,
            'name' => 'Dusmara',
            'state_id' => 59,
        ]);

        City::create([
            'id' => 383,
            'name' => 'Kachakata',
            'state_id' => 59,
        ]);

        City::create([
            'id' => 384,
            'name' => 'Rajibpur',
            'state_id' => 59,
        ]);

        City::create([
            'id' => 385,
            'name' => 'Bheramara',
            'state_id' => 30,
        ]);

        City::create([
            'id' => 386,
            'name' => 'Daulatpur',
            'state_id' => 30,
        ]);

        City::create([
            'id' => 387,
            'name' => 'Khoksa',
            'state_id' => 30,
        ]);

        City::create([
            'id' => 388,
            'name' => 'Kumarkhali',
            'state_id' => 30,
        ]);

        City::create([
            'id' => 389,
            'name' => 'Kushtia Sadar',
            'state_id' => 30,
        ]);

        City::create([
            'id' => 390,
            'name' => 'Mirpur',
            'state_id' => 30,
        ]);

        City::create([
            'id' => 391,
            'name' => 'Shekhpara',
            'state_id' => 30,
        ]);

        City::create([
            'id' => 392,
            'name' => 'Islamic University',
            'state_id' => 30,
        ]);

        City::create([
            'id' => 393,
            'name' => 'Rafayetpur',
            'state_id' => 30,
        ]);

        City::create([
            'id' => 394,
            'name' => 'Aditmari',
            'state_id' => 64,
        ]);

        City::create([
            'id' => 395,
            'name' => 'Hatibandha',
            'state_id' => 64,
        ]);

        City::create([
            'id' => 396,
            'name' => 'Kaliganj',
            'state_id' => 64,
        ]);

        City::create([
            'id' => 397,
            'name' => 'Lalmonirhat Sadar',
            'state_id' => 64,
        ]);

        City::create([
            'id' => 398,
            'name' => 'Patgram',
            'state_id' => 64,
        ]);

        City::create([
            'id' => 399,
            'name' => 'Tushbhandar',
            'state_id' => 64,
        ]);

        City::create([
            'id' => 400,
            'name' => 'Kamalnagar',
            'state_id' => 20,
        ]);

        City::create([
            'id' => 401,
            'name' => 'Lakshmipur Sadar',
            'state_id' => 20,
        ]);

        City::create([
            'id' => 402,
            'name' => 'Raipur',
            'state_id' => 20,
        ]);

        City::create([
            'id' => 403,
            'name' => 'Ramganj',
            'state_id' => 20,
        ]);

        City::create([
            'id' => 404,
            'name' => 'Ramgati',
            'state_id' => 20,
        ]);

        City::create([
            'id' => 405,
            'name' => 'Char Alexgander',
            'state_id' => 20,
        ]);

        City::create([
            'id' => 406,
            'name' => 'Kalkini',
            'state_id' => 11,
        ]);

        City::create([
            'id' => 407,
            'name' => 'Madaripur Sadar',
            'state_id' => 11,
        ]);

        City::create([
            'id' => 408,
            'name' => 'Rajoir',
            'state_id' => 11,
        ]);

        City::create([
            'id' => 409,
            'name' => 'Shibchar',
            'state_id' => 11,
        ]);

        City::create([
            'id' => 410,
            'name' => 'Dashar',
            'state_id' => 11,
        ]);

        City::create([
            'id' => 411,
            'name' => 'Barhamganj',
            'state_id' => 11,
        ]);

        City::create([
            'id' => 412,
            'name' => 'Magura Sadar',
            'state_id' => 31,
        ]);

        City::create([
            'id' => 413,
            'name' => 'Mohammadpur',
            'state_id' => 31,
        ]);

        City::create([
            'id' => 414,
            'name' => 'Shalikha',
            'state_id' => 31,
        ]);

        City::create([
            'id' => 415,
            'name' => 'Sreepur',
            'state_id' => 31,
        ]);

        City::create([
            'id' => 416,
            'name' => 'Arpara',
            'state_id' => 31,
        ]);

        City::create([
            'id' => 417,
            'name' => 'Daulatpur',
            'state_id' => 4,
        ]);

        City::create([
            'id' => 418,
            'name' => 'Ghior',
            'state_id' => 4,
        ]);

        City::create([
            'id' => 419,
            'name' => 'Harirampur',
            'state_id' => 4,
        ]);

        City::create([
            'id' => 420,
            'name' => 'Manikganj Sadar',
            'state_id' => 4,
        ]);

        City::create([
            'id' => 421,
            'name' => 'Saturia',
            'state_id' => 4,
        ]);

        City::create([
            'id' => 422,
            'name' => 'Shivalaya',
            'state_id' => 4,
        ]);

        City::create([
            'id' => 423,
            'name' => 'Singair',
            'state_id' => 4,
        ]);

        City::create([
            'id' => 424,
            'name' => 'Gangni',
            'state_id' => 32,
        ]);

        City::create([
            'id' => 425,
            'name' => 'Meherpur Sadar',
            'state_id' => 32,
        ]);

        City::create([
            'id' => 426,
            'name' => 'Mujibnagar',
            'state_id' => 32,
        ]);

        City::create([
            'id' => 427,
            'name' => 'Baralekha',
            'state_id' => 36,
        ]);

        City::create([
            'id' => 428,
            'name' => 'Juri',
            'state_id' => 36,
        ]);

        City::create([
            'id' => 429,
            'name' => 'Kamalganj',
            'state_id' => 36,
        ]);

        City::create([
            'id' => 430,
            'name' => 'Kulaura',
            'state_id' => 36,
        ]);

        City::create([
            'id' => 431,
            'name' => 'Moulvibazar Sadar',
            'state_id' => 36,
        ]);

        City::create([
            'id' => 432,
            'name' => 'Rajnagar',
            'state_id' => 36,
        ]);

        City::create([
            'id' => 433,
            'name' => 'Sreemangal',
            'state_id' => 36,
        ]);

        City::create([
            'id' => 434,
            'name' => 'Gazaria',
            'state_id' => 5,
        ]);

        City::create([
            'id' => 435,
            'name' => 'Lohajang',
            'state_id' => 5,
        ]);

        City::create([
            'id' => 436,
            'name' => 'Munshiganj Sadar',
            'state_id' => 5,
        ]);

        City::create([
            'id' => 437,
            'name' => 'Sirajdikhan',
            'state_id' => 5,
        ]);

        City::create([
            'id' => 438,
            'name' => 'Sreenagar',
            'state_id' => 5,
        ]);

        City::create([
            'id' => 439,
            'name' => 'Tongibari',
            'state_id' => 5,
        ]);

        City::create([
            'id' => 440,
            'name' => 'Bhaluka',
            'state_id' => 39,
        ]);

        City::create([
            'id' => 441,
            'name' => 'Dhobaura',
            'state_id' => 39,
        ]);

        City::create([
            'id' => 442,
            'name' => 'Fulbaria',
            'state_id' => 39,
        ]);

        City::create([
            'id' => 443,
            'name' => 'Gaffargaon',
            'state_id' => 39,
        ]);

        City::create([
            'id' => 444,
            'name' => 'Gouripur',
            'state_id' => 39,
        ]);

        City::create([
            'id' => 445,
            'name' => 'Haluaghat',
            'state_id' => 39,
        ]);

        City::create([
            'id' => 446,
            'name' => 'Isshwargonj',
            'state_id' => 39,
        ]);

        City::create([
            'id' => 447,
            'name' => 'Muktagachha',
            'state_id' => 39,
        ]);

        City::create([
            'id' => 448,
            'name' => 'Mymensingh Sadar',
            'state_id' => 39,
        ]);

        City::create([
            'id' => 449,
            'name' => 'Nandail',
            'state_id' => 39,
        ]);

        City::create([
            'id' => 450,
            'name' => 'Phulpur',
            'state_id' => 39,
        ]);

        City::create([
            'id' => 451,
            'name' => 'Tara Khanda',
            'state_id' => 39,
        ]);

        City::create([
            'id' => 452,
            'name' => 'Trishal',
            'state_id' => 39,
        ]);

        City::create([
            'id' => 453,
            'name' => 'Tarakanda',
            'state_id' => 39,
        ]);

        City::create([
            'id' => 454,
            'name' => 'Atrai',
            'state_id' => 45,
        ]);

        City::create([
            'id' => 455,
            'name' => 'Badalgachhi',
            'state_id' => 45,
        ]);

        City::create([
            'id' => 456,
            'name' => 'Dhamoirhat',
            'state_id' => 45,
        ]);

        City::create([
            'id' => 457,
            'name' => 'Manda',
            'state_id' => 45,
        ]);

        City::create([
            'id' => 458,
            'name' => 'Mohadevpur',
            'state_id' => 45,
        ]);

        City::create([
            'id' => 459,
            'name' => 'Naogaon Sadar',
            'state_id' => 45,
        ]);

        City::create([
            'id' => 460,
            'name' => 'Niamatpur',
            'state_id' => 45,
        ]);

        City::create([
            'id' => 461,
            'name' => 'Patnitala',
            'state_id' => 45,
        ]);

        City::create([
            'id' => 462,
            'name' => 'Porsa',
            'state_id' => 45,
        ]);

        City::create([
            'id' => 463,
            'name' => 'Raninagar',
            'state_id' => 45,
        ]);

        City::create([
            'id' => 464,
            'name' => 'Sapahar',
            'state_id' => 45,
        ]);

        City::create([
            'id' => 465,
            'name' => 'Prasadpur',
            'state_id' => 45,
        ]);

        City::create([
            'id' => 466,
            'name' => 'Nitpur',
            'state_id' => 45,
        ]);

        City::create([
            'id' => 467,
            'name' => 'Ahsanganj',
            'state_id' => 45,
        ]);

        City::create([
            'id' => 468,
            'name' => 'Kalia',
            'state_id' => 33,
        ]);

        City::create([
            'id' => 469,
            'name' => 'Lohagora',
            'state_id' => 33,
        ]);

        City::create([
            'id' => 470,
            'name' => 'Naragati',
            'state_id' => 33,
        ]);

        City::create([
            'id' => 471,
            'name' => 'Narail Sadar',
            'state_id' => 33,
        ]);

        City::create([
            'id' => 472,
            'name' => 'Naragathi',
            'state_id' => 33,
        ]);

        City::create([
            'id' => 473,
            'name' => 'Mohajan',
            'state_id' => 33,
        ]);

        City::create([
            'id' => 474,
            'name' => 'Laxmipasha',
            'state_id' => 33,
        ]);

        City::create([
            'id' => 475,
            'name' => 'Araihazar',
            'state_id' => 6,
        ]);

        City::create([
            'id' => 476,
            'name' => 'Bandar',
            'state_id' => 6,
        ]);

        City::create([
            'id' => 477,
            'name' => 'Narayanganj Sadar',
            'state_id' => 6,
        ]);

        City::create([
            'id' => 478,
            'name' => 'Rupganj',
            'state_id' => 6,
        ]);

        City::create([
            'id' => 479,
            'name' => 'Sonargaon',
            'state_id' => 6,
        ]);

        City::create([
            'id' => 480,
            'name' => 'Fatullah',
            'state_id' => 6,
        ]);

        City::create([
            'id' => 481,
            'name' => 'Siddirganj',
            'state_id' => 6,
        ]);

        City::create([
            'id' => 482,
            'name' => 'Baidder Bazar',
            'state_id' => 6,
        ]);

        City::create([
            'id' => 483,
            'name' => 'Belabo',
            'state_id' => 7,
        ]);

        City::create([
            'id' => 484,
            'name' => 'Monohardi',
            'state_id' => 7,
        ]);

        City::create([
            'id' => 485,
            'name' => 'Narsingdi Sadar',
            'state_id' => 7,
        ]);

        City::create([
            'id' => 486,
            'name' => 'Palash',
            'state_id' => 7,
        ]);

        City::create([
            'id' => 487,
            'name' => 'Raipura',
            'state_id' => 7,
        ]);

        City::create([
            'id' => 488,
            'name' => 'Shibpur',
            'state_id' => 7,
        ]);

        City::create([
            'id' => 489,
            'name' => 'Bagatipara',
            'state_id' => 44,
        ]);

        City::create([
            'id' => 490,
            'name' => 'Baraigram',
            'state_id' => 44,
        ]);

        City::create([
            'id' => 491,
            'name' => 'Gurudaspur',
            'state_id' => 44,
        ]);

        City::create([
            'id' => 492,
            'name' => 'Lalpur',
            'state_id' => 44,
        ]);

        City::create([
            'id' => 493,
            'name' => 'Naldanga',
            'state_id' => 44,
        ]);

        City::create([
            'id' => 494,
            'name' => 'Natore Sadar',
            'state_id' => 44,
        ]);

        City::create([
            'id' => 495,
            'name' => 'Singra',
            'state_id' => 44,
        ]);

        City::create([
            'id' => 496,
            'name' => 'Laxman',
            'state_id' => 44,
        ]);

        City::create([
            'id' => 497,
            'name' => 'Harua',
            'state_id' => 44,
        ]);

        City::create([
            'id' => 498,
            'name' => 'Atpara',
            'state_id' => 40,
        ]);

        City::create([
            'id' => 499,
            'name' => 'Barhatta',
            'state_id' => 40,
        ]);

        City::create([
            'id' => 500,
            'name' => 'Durgapur',
            'state_id' => 40,
        ]);

        City::create([
            'id' => 501,
            'name' => 'Kalmakanda',
            'state_id' => 40,
        ]);

        City::create([
            'id' => 502,
            'name' => 'Kendua',
            'state_id' => 40,
        ]);

        City::create([
            'id' => 503,
            'name' => 'Khaliajhri',
            'state_id' => 40,
        ]);

        City::create([
            'id' => 504,
            'name' => 'Madan',
            'state_id' => 40,
        ]);

        City::create([
            'id' => 505,
            'name' => 'Mohanganj',
            'state_id' => 40,
        ]);

        City::create([
            'id' => 506,
            'name' => 'Netrakona Sadar',
            'state_id' => 40,
        ]);

        City::create([
            'id' => 507,
            'name' => 'Purbadhola',
            'state_id' => 40,
        ]);

        City::create([
            'id' => 508,
            'name' => 'Moddoynagar',
            'state_id' => 40,
        ]);

        City::create([
            'id' => 509,
            'name' => 'Dhobaura',
            'state_id' => 40,
        ]);

        City::create([
            'id' => 510,
            'name' => 'Susnng Durgapur',
            'state_id' => 40,
        ]);

        City::create([
            'id' => 511,
            'name' => 'Dimla',
            'state_id' => 60,
        ]);

        City::create([
            'id' => 512,
            'name' => 'Domar',
            'state_id' => 60,
        ]);

        City::create([
            'id' => 513,
            'name' => 'Jaldhaka',
            'state_id' => 60,
        ]);

        City::create([
            'id' => 514,
            'name' => 'Kishoriganj',
            'state_id' => 60,
        ]);

        City::create([
            'id' => 515,
            'name' => 'Nilphamari Sadar',
            'state_id' => 60,
        ]);

        City::create([
            'id' => 516,
            'name' => 'Saidpur',
            'state_id' => 60,
        ]);

        City::create([
            'id' => 517,
            'name' => 'Begumganj',
            'state_id' => 15,
        ]);

        City::create([
            'id' => 518,
            'name' => 'Chatkhil',
            'state_id' => 15,
        ]);

        City::create([
            'id' => 519,
            'name' => 'Companiganj',
            'state_id' => 15,
        ]);

        City::create([
            'id' => 520,
            'name' => 'Hatiya',
            'state_id' => 15,
        ]);

        City::create([
            'id' => 521,
            'name' => 'Kabirhat',
            'state_id' => 15,
        ]);

        City::create([
            'id' => 522,
            'name' => 'Noakhali Sadar',
            'state_id' => 15,
        ]);

        City::create([
            'id' => 523,
            'name' => 'Senbag',
            'state_id' => 15,
        ]);

        City::create([
            'id' => 524,
            'name' => 'Sonaimuri',
            'state_id' => 15,
        ]);

        City::create([
            'id' => 525,
            'name' => 'Subarnachar',
            'state_id' => 15,
        ]);

        City::create([
            'id' => 526,
            'name' => 'Char Jabbar',
            'state_id' => 15,
        ]);

        City::create([
            'id' => 527,
            'name' => 'Sudharam',
            'state_id' => 15,
        ]);

        City::create([
            'id' => 528,
            'name' => 'Basur Hat',
            'state_id' => 15,
        ]);

        City::create([
            'id' => 529,
            'name' => 'Ataikula',
            'state_id' => 47,
        ]);

        City::create([
            'id' => 530,
            'name' => 'Atgharia',
            'state_id' => 47,
        ]);

        City::create([
            'id' => 531,
            'name' => 'Bera',
            'state_id' => 47,
        ]);

        City::create([
            'id' => 532,
            'name' => 'Bhangura',
            'state_id' => 47,
        ]);

        City::create([
            'id' => 533,
            'name' => 'Chatmohar',
            'state_id' => 47,
        ]);

        City::create([
            'id' => 534,
            'name' => 'Faridpur',
            'state_id' => 47,
        ]);

        City::create([
            'id' => 535,
            'name' => 'Ishwardi',
            'state_id' => 47,
        ]);

        City::create([
            'id' => 536,
            'name' => 'Pabna Sadar',
            'state_id' => 47,
        ]);

        City::create([
            'id' => 537,
            'name' => 'Sathia',
            'state_id' => 47,
        ]);

        City::create([
            'id' => 538,
            'name' => 'Sujanagar',
            'state_id' => 47,
        ]);

        City::create([
            'id' => 539,
            'name' => 'Aminpur',
            'state_id' => 47,
        ]);

        City::create([
            'id' => 540,
            'name' => 'Debottar',
            'state_id' => 47,
        ]);

        City::create([
            'id' => 541,
            'name' => 'Banwarinagar',
            'state_id' => 47,
        ]);

        City::create([
            'id' => 542,
            'name' => 'Atwari',
            'state_id' => 63,
        ]);

        City::create([
            'id' => 543,
            'name' => 'Boda',
            'state_id' => 63,
        ]);

        City::create([
            'id' => 544,
            'name' => 'Dabiganj',
            'state_id' => 63,
        ]);

        City::create([
            'id' => 545,
            'name' => 'Panchagar Sadar',
            'state_id' => 63,
        ]);

        City::create([
            'id' => 546,
            'name' => 'Tetulia',
            'state_id' => 63,
        ]);

        City::create([
            'id' => 547,
            'name' => 'Chotto Dab',
            'state_id' => 63,
        ]);

        City::create([
            'id' => 548,
            'name' => 'Bauphal',
            'state_id' => 55,
        ]);

        City::create([
            'id' => 549,
            'name' => 'Dashmina',
            'state_id' => 55,
        ]);

        City::create([
            'id' => 550,
            'name' => 'Dumki',
            'state_id' => 55,
        ]);

        City::create([
            'id' => 551,
            'name' => 'Galachipa',
            'state_id' => 55,
        ]);

        City::create([
            'id' => 552,
            'name' => 'Kalapara',
            'state_id' => 55,
        ]);

        City::create([
            'id' => 553,
            'name' => 'Mirzaganj',
            'state_id' => 55,
        ]);

        City::create([
            'id' => 554,
            'name' => 'Patuakhali Sadar',
            'state_id' => 55,
        ]);

        City::create([
            'id' => 555,
            'name' => 'Rangabali',
            'state_id' => 55,
        ]);

        City::create([
            'id' => 556,
            'name' => 'Khepupara',
            'state_id' => 55,
        ]);

        City::create([
            'id' => 557,
            'name' => 'Subidkhali',
            'state_id' => 55,
        ]);

        City::create([
            'id' => 558,
            'name' => 'Mohipur',
            'state_id' => 55,
        ]);

        City::create([
            'id' => 559,
            'name' => 'Bhandaria',
            'state_id' => 56,
        ]);

        City::create([
            'id' => 560,
            'name' => 'Kaukhali ',
            'state_id' => 56,
        ]);

        City::create([
            'id' => 561,
            'name' => 'Mathbaria',
            'state_id' => 56,
        ]);

        City::create([
            'id' => 562,
            'name' => 'Nazirpur',
            'state_id' => 56,
        ]);

        City::create([
            'id' => 563,
            'name' => 'Nesarabad',
            'state_id' => 56,
        ]);

        City::create([
            'id' => 564,
            'name' => 'Pirojpur Sadar',
            'state_id' => 56,
        ]);

        City::create([
            'id' => 565,
            'name' => 'Zianagor',
            'state_id' => 56,
        ]);

        City::create([
            'id' => 566,
            'name' => 'Swarupkathi',
            'state_id' => 56,
        ]);

        City::create([
            'id' => 567,
            'name' => 'Indurkani',
            'state_id' => 56,
        ]);

        City::create([
            'id' => 568,
            'name' => 'Zianagar',
            'state_id' => 56,
        ]);

        City::create([
            'id' => 569,
            'name' => 'Baliakandi',
            'state_id' => 12,
        ]);

        City::create([
            'id' => 570,
            'name' => 'Goalandaghat',
            'state_id' => 12,
        ]);

        City::create([
            'id' => 571,
            'name' => 'Kalukhali',
            'state_id' => 12,
        ]);

        City::create([
            'id' => 572,
            'name' => 'Pangsha',
            'state_id' => 12,
        ]);

        City::create([
            'id' => 573,
            'name' => 'Rajbari Sadar',
            'state_id' => 12,
        ]);

        City::create([
            'id' => 574,
            'name' => 'Bagha',
            'state_id' => 43,
        ]);

        City::create([
            'id' => 575,
            'name' => 'Bagmara',
            'state_id' => 43,
        ]);

        City::create([
            'id' => 576,
            'name' => 'Boalia',
            'state_id' => 43,
        ]);

        City::create([
            'id' => 577,
            'name' => 'Charghat',
            'state_id' => 43,
        ]);

        City::create([
            'id' => 578,
            'name' => 'Durgapur',
            'state_id' => 43,
        ]);

        City::create([
            'id' => 579,
            'name' => 'Durgapur',
            'state_id' => 43,
        ]);

        City::create([
            'id' => 580,
            'name' => 'Matihar',
            'state_id' => 43,
        ]);

        City::create([
            'id' => 581,
            'name' => 'Mohanpur',
            'state_id' => 43,
        ]);

        City::create([
            'id' => 582,
            'name' => 'Paba',
            'state_id' => 43,
        ]);

        City::create([
            'id' => 583,
            'name' => 'Putia',
            'state_id' => 43,
        ]);

        City::create([
            'id' => 584,
            'name' => 'Rajpara',
            'state_id' => 43,
        ]);

        City::create([
            'id' => 585,
            'name' => 'Shah Mokdum',
            'state_id' => 43,
        ]);

        City::create([
            'id' => 586,
            'name' => 'Tanore',
            'state_id' => 43,
        ]);

        City::create([
            'id' => 587,
            'name' => 'Rajshahi Sadar',
            'state_id' => 43,
        ]);

        City::create([
            'id' => 588,
            'name' => 'Shah Makhdum',
            'state_id' => 43,
        ]);

        City::create([
            'id' => 589,
            'name' => 'Baghaichhari',
            'state_id' => 22,
        ]);

        City::create([
            'id' => 590,
            'name' => 'Barakal',
            'state_id' => 22,
        ]);

        City::create([
            'id' => 591,
            'name' => 'Bilaichari',
            'state_id' => 22,
        ]);

        City::create([
            'id' => 592,
            'name' => 'Jarachhari',
            'state_id' => 22,
        ]);

        City::create([
            'id' => 593,
            'name' => 'Kaptai',
            'state_id' => 22,
        ]);

        City::create([
            'id' => 594,
            'name' => 'Kaukhali ',
            'state_id' => 22,
        ]);

        City::create([
            'id' => 595,
            'name' => 'Langadu',
            'state_id' => 22,
        ]);

        City::create([
            'id' => 596,
            'name' => 'Naniarchar',
            'state_id' => 22,
        ]);

        City::create([
            'id' => 597,
            'name' => 'Rajasthali',
            'state_id' => 22,
        ]);

        City::create([
            'id' => 598,
            'name' => 'Rangamati Sadar',
            'state_id' => 22,
        ]);

        City::create([
            'id' => 599,
            'name' => 'Nanichhar',
            'state_id' => 22,
        ]);

        City::create([
            'id' => 600,
            'name' => 'Marishya',
            'state_id' => 22,
        ]);

        City::create([
            'id' => 601,
            'name' => 'Longachh',
            'state_id' => 22,
        ]);

        City::create([
            'id' => 602,
            'name' => 'Kalampati',
            'state_id' => 22,
        ]);

        City::create([
            'id' => 603,
            'name' => 'Badarganj',
            'state_id' => 57,
        ]);

        City::create([
            'id' => 604,
            'name' => 'Gangachhara',
            'state_id' => 57,
        ]);

        City::create([
            'id' => 605,
            'name' => 'Kaunia',
            'state_id' => 57,
        ]);

        City::create([
            'id' => 606,
            'name' => 'Mithapukur',
            'state_id' => 57,
        ]);

        City::create([
            'id' => 607,
            'name' => 'Pirgachha',
            'state_id' => 57,
        ]);

        City::create([
            'id' => 608,
            'name' => 'Pirganj',
            'state_id' => 57,
        ]);

        City::create([
            'id' => 609,
            'name' => 'Rangpur Sadar',
            'state_id' => 57,
        ]);

        City::create([
            'id' => 610,
            'name' => 'Taraganj',
            'state_id' => 57,
        ]);

        City::create([
            'id' => 611,
            'name' => 'Mitha Pukur',
            'state_id' => 57,
        ]);

        City::create([
            'id' => 612,
            'name' => 'Kotwali',
            'state_id' => 57,
        ]);

        City::create([
            'id' => 613,
            'name' => 'Assasuni',
            'state_id' => 34,
        ]);

        City::create([
            'id' => 614,
            'name' => 'Debhata',
            'state_id' => 34,
        ]);

        City::create([
            'id' => 615,
            'name' => 'Kalaroa',
            'state_id' => 34,
        ]);

        City::create([
            'id' => 616,
            'name' => 'Kaliganj',
            'state_id' => 34,
        ]);

        City::create([
            'id' => 617,
            'name' => 'Satkhira Sadar',
            'state_id' => 34,
        ]);

        City::create([
            'id' => 618,
            'name' => 'Shyamnagar',
            'state_id' => 34,
        ]);

        City::create([
            'id' => 619,
            'name' => 'Tala',
            'state_id' => 34,
        ]);

        City::create([
            'id' => 620,
            'name' => 'Nakipur',
            'state_id' => 34,
        ]);

        City::create([
            'id' => 621,
            'name' => 'Bhedarganj',
            'state_id' => 13,
        ]);

        City::create([
            'id' => 622,
            'name' => 'Damudya',
            'state_id' => 13,
        ]);

        City::create([
            'id' => 623,
            'name' => 'Gosairhat',
            'state_id' => 13,
        ]);

        City::create([
            'id' => 624,
            'name' => 'Naria',
            'state_id' => 13,
        ]);

        City::create([
            'id' => 625,
            'name' => 'Shakhipur',
            'state_id' => 13,
        ]);

        City::create([
            'id' => 626,
            'name' => 'Shariatpur Sadar',
            'state_id' => 13,
        ]);

        City::create([
            'id' => 627,
            'name' => 'Zanjira',
            'state_id' => 13,
        ]);

        City::create([
            'id' => 628,
            'name' => 'Jhenaigati',
            'state_id' => 42,
        ]);

        City::create([
            'id' => 629,
            'name' => 'Nakla',
            'state_id' => 42,
        ]);

        City::create([
            'id' => 630,
            'name' => 'Nalitabari',
            'state_id' => 42,
        ]);

        City::create([
            'id' => 631,
            'name' => 'Sherpur Sadar',
            'state_id' => 42,
        ]);

        City::create([
            'id' => 632,
            'name' => 'Shribardi',
            'state_id' => 42,
        ]);

        City::create([
            'id' => 633,
            'name' => 'Bakshigonj',
            'state_id' => 42,
        ]);

        City::create([
            'id' => 634,
            'name' => 'Belkuchi',
            'state_id' => 46,
        ]);

        City::create([
            'id' => 635,
            'name' => 'Chauhali',
            'state_id' => 46,
        ]);

        City::create([
            'id' => 636,
            'name' => 'Kamarkhanda',
            'state_id' => 46,
        ]);

        City::create([
            'id' => 637,
            'name' => 'Kazipur',
            'state_id' => 46,
        ]);

        City::create([
            'id' => 638,
            'name' => 'Raiganj',
            'state_id' => 46,
        ]);

        City::create([
            'id' => 639,
            'name' => 'Shahjadpur',
            'state_id' => 46,
        ]);

        City::create([
            'id' => 640,
            'name' => 'Sirajganj Sadar',
            'state_id' => 46,
        ]);

        City::create([
            'id' => 641,
            'name' => 'Tarash',
            'state_id' => 46,
        ]);

        City::create([
            'id' => 642,
            'name' => 'Ullapara',
            'state_id' => 46,
        ]);

        City::create([
            'id' => 643,
            'name' => 'Bangabandhu Bridge West',
            'state_id' => 46,
        ]);

        City::create([
            'id' => 644,
            'name' => 'Kamarkanda',
            'state_id' => 46,
        ]);

        City::create([
            'id' => 645,
            'name' => 'Salanga',
            'state_id' => 46,
        ]);

        City::create([
            'id' => 646,
            'name' => 'Dhangora',
            'state_id' => 46,
        ]);

        City::create([
            'id' => 647,
            'name' => 'Baiddya Jam Toil',
            'state_id' => 46,
        ]);

        City::create([
            'id' => 648,
            'name' => 'Bishwamvarpur',
            'state_id' => 37,
        ]);

        City::create([
            'id' => 649,
            'name' => 'Chhatak',
            'state_id' => 37,
        ]);

        City::create([
            'id' => 650,
            'name' => 'Derai',
            'state_id' => 37,
        ]);

        City::create([
            'id' => 651,
            'name' => 'Dharampasha',
            'state_id' => 37,
        ]);

        City::create([
            'id' => 652,
            'name' => 'Dowarabazar',
            'state_id' => 37,
        ]);

        City::create([
            'id' => 653,
            'name' => 'Jagnnathpur',
            'state_id' => 37,
        ]);

        City::create([
            'id' => 654,
            'name' => 'Jamalganj',
            'state_id' => 37,
        ]);

        City::create([
            'id' => 655,
            'name' => 'Dakshin Sunamganj',
            'state_id' => 37,
        ]);

        City::create([
            'id' => 656,
            'name' => 'Sullah',
            'state_id' => 37,
        ]);

        City::create([
            'id' => 657,
            'name' => 'Sunamganj Sadar',
            'state_id' => 37,
        ]);

        City::create([
            'id' => 658,
            'name' => 'Tahirpur',
            'state_id' => 37,
        ]);

        City::create([
            'id' => 659,
            'name' => 'Sachna',
            'state_id' => 37,
        ]);

        City::create([
            'id' => 660,
            'name' => 'Ghungiar',
            'state_id' => 37,
        ]);

        City::create([
            'id' => 661,
            'name' => 'Balaganj',
            'state_id' => 38,
        ]);

        City::create([
            'id' => 662,
            'name' => 'Beanibazar',
            'state_id' => 38,
        ]);

        City::create([
            'id' => 663,
            'name' => 'Bishwanath',
            'state_id' => 38,
        ]);

        City::create([
            'id' => 664,
            'name' => 'Companiganj',
            'state_id' => 38,
        ]);

        City::create([
            'id' => 665,
            'name' => 'Fenchuganj',
            'state_id' => 38,
        ]);

        City::create([
            'id' => 666,
            'name' => 'Golapganj',
            'state_id' => 38,
        ]);

        City::create([
            'id' => 667,
            'name' => 'Goainghat',
            'state_id' => 38,
        ]);

        City::create([
            'id' => 668,
            'name' => 'Jaintapur',
            'state_id' => 38,
        ]);

        City::create([
            'id' => 669,
            'name' => 'Kanaighat',
            'state_id' => 38,
        ]);

        City::create([
            'id' => 670,
            'name' => 'South Shurma',
            'state_id' => 38,
        ]);

        City::create([
            'id' => 671,
            'name' => 'Sylhet Sadar',
            'state_id' => 38,
        ]);

        City::create([
            'id' => 672,
            'name' => 'Jakiganj',
            'state_id' => 38,
        ]);

        City::create([
            'id' => 673,
            'name' => 'Osmani Nagar',
            'state_id' => 38,
        ]);

        City::create([
            'id' => 674,
            'name' => 'Mogla Bazar',
            'state_id' => 38,
        ]);

        City::create([
            'id' => 675,
            'name' => 'Shahporan',
            'state_id' => 38,
        ]);

        City::create([
            'id' => 676,
            'name' => 'Dakshin Surma',
            'state_id' => 38,
        ]);

        City::create([
            'id' => 677,
            'name' => 'Moddho Nagar',
            'state_id' => 38,
        ]);

        City::create([
            'id' => 678,
            'name' => 'Moglabazar',
            'state_id' => 38,
        ]);

        City::create([
            'id' => 679,
            'name' => 'Shahparan (R:)',
            'state_id' => 38,
        ]);

        City::create([
            'id' => 680,
            'name' => 'Basail',
            'state_id' => 8,
        ]);

        City::create([
            'id' => 681,
            'name' => 'Bhuapur',
            'state_id' => 8,
        ]);

        City::create([
            'id' => 682,
            'name' => 'Delduar',
            'state_id' => 8,
        ]);

        City::create([
            'id' => 683,
            'name' => 'Dhanbari',
            'state_id' => 8,
        ]);

        City::create([
            'id' => 684,
            'name' => 'Ghatail',
            'state_id' => 8,
        ]);

        City::create([
            'id' => 685,
            'name' => 'Gopalpur',
            'state_id' => 8,
        ]);

        City::create([
            'id' => 686,
            'name' => 'Kalihati',
            'state_id' => 8,
        ]);

        City::create([
            'id' => 687,
            'name' => 'Madhupur',
            'state_id' => 8,
        ]);

        City::create([
            'id' => 688,
            'name' => 'Mirzapur',
            'state_id' => 8,
        ]);

        City::create([
            'id' => 689,
            'name' => 'Nagarpur',
            'state_id' => 8,
        ]);

        City::create([
            'id' => 690,
            'name' => 'Sakhipur',
            'state_id' => 8,
        ]);

        City::create([
            'id' => 691,
            'name' => 'Tangail Sadar',
            'state_id' => 8,
        ]);

        City::create([
            'id' => 692,
            'name' => 'Bangabandu East Ps',
            'state_id' => 8,
        ]);

        City::create([
            'id' => 693,
            'name' => 'Jamuna Bridge (East)',
            'state_id' => 8,
        ]);

        City::create([
            'id' => 694,
            'name' => 'Kashkawlia',
            'state_id' => 8,
        ]);

        City::create([
            'id' => 695,
            'name' => 'Baliadangi',
            'state_id' => 62,
        ]);

        City::create([
            'id' => 696,
            'name' => 'Haripur',
            'state_id' => 62,
        ]);

        City::create([
            'id' => 697,
            'name' => 'Pirganj',
            'state_id' => 62,
        ]);

        City::create([
            'id' => 698,
            'name' => 'Rani Sankail',
            'state_id' => 62,
        ]);

        City::create([
            'id' => 699,
            'name' => 'Thakurgaon Sadar',
            'state_id' => 62,
        ]);

        City::create([
            'id' => 700,
            'name' => 'Jibanpur',
            'state_id' => 62,
        ]);
    }
}
