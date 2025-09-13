<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\PermissionGroup;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::truncate();
        $permissions = [

            // Group - Location
            [
                'group_id'=>1,
                'parent_id'=>0,
                'name'=>'Country',
                'meta_name'=>'country',
                'type'=>1
            ],
            [
                'group_id'=>1,
                'parent_id'=>0,
                'name'=>'City',
                'meta_name'=>'city',
                'type'=>1
            ],
            [
                'group_id'=>1,
                'parent_id'=>0,
                'name'=>'State',
                'meta_name'=>'state',
                'type'=>1
            ],
            // Group - Administrator

            // parent roles
            [
                'group_id'=>3,
                'parent_id'=>0,
                'name'=>'Roles',
                'meta_name'=>'roles',
                'type'=>1
            ],
            [
                'group_id'=>3,
                'parent_id'=>5,
                'name'=>'Create',
                'meta_name'=>'roles-create',
                'type'=>1
            ],
            [
                'group_id'=>3,
                'parent_id'=>5,
                'name'=>'Update',
                'meta_name'=>'roles-update',
                'type'=>1
            ],
            [
                'group_id'=>3,
                'parent_id'=>5,
                'name'=>'Delete',
                'meta_name'=>'roles-delete',
                'type'=>1
            ],
            
            // parent users
            [
                'group_id'=>3,
                'parent_id'=>0,
                'name'=>'Users',
                'meta_name'=>'users',
                'type'=>1
            ],
            [
                'group_id'=>3,
                'parent_id'=>9,
                'name'=>'Create',
                'meta_name'=>'users-create',
                'type'=>1
            ],
            [
                'group_id'=>3,
                'parent_id'=>9,
                'name'=>'Update',
                'meta_name'=>'users-update',
                'type'=>1
            ],
            [
                'group_id'=>3,
                'parent_id'=>9,
                'name'=>'Delete',
                'meta_name'=>'users-delete',
                'type'=>1
            ],

            // Group - General Setting
            // parent General Setting
            [
                'group_id'=>10,
                'parent_id'=>0,
                'name'=>'General Setting',
                'meta_name'=>'general-setting',
                'type'=>1
            ],

        ];

        Permission::insert($permissions);

    }
}
