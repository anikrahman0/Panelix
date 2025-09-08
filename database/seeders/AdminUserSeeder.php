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
            'email' => 'deal@adm.com',
            'phone'=>'01XXXXXXXXX0',
            'gender'=>1,
            'password' => Hash::make('deal@0o.com'),
            'status' => 1,
            'email_verified_at'=>Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Null,
        ]);
        AdminUser::create([
            'role_id'=>1,
            'country_id'=>1,
            'name'=>'emyth',
            'email' => 'emythmakers@gmail.com',
            'phone'=>'01XXXXXXXXX1',
            'gender'=>1,
            'password' => Hash::make('e123456@#'),
            'status' => 1,
            'email_verified_at'=>Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Null,
        ]);
    }
}
