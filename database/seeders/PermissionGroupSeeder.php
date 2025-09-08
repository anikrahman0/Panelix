<?php

namespace Database\Seeders;

use App\Models\PermissionGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PermissionGroup::truncate();

        $permission_groups = [
            [
                'name' => 'Location',
                'type' => 1,
            ],
            [
                'name' => 'Payments',
                'type' => 1,
            ],
            [
                'name' => 'Administrator',
                'type' => 1,
            ],
            [
                'name' => 'Authors',
                'type' => 1,
            ],
            [
                'name' => 'Publishers',
                'type' => 1,
            ],
            [
                'name' => 'Book Listing',
                'type' => 1,
            ],
            [
                'name' => 'Orders',
                'type' => 1,
            ],
            [
                'name' => 'Marketing',
                'type' => 1,
            ],
            [
                'name' => 'Social Media',
                'type' => 1,
            ],
            [
                'name' => 'General Settings',
                'type' => 1,
            ],
        ];

        PermissionGroup::insert($permission_groups);

    }
}
