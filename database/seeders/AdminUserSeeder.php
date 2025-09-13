<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\AdminUser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AdminUser::truncate();
        AdminUser::create([
            'role_id'=>1,
            'country_id'=>1,
            'name'=>'admin',
            'email' => 'panelix@rootadmin.com',
            'phone'=>'000000001',
            'gender'=>1,
            'password' => Hash::make('adm@Panelix238'),
            'status' => 1,
            'is_super' => 1,
            'email_verified_at'=>Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Null,
        ]);
    }
}
