<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\RolePermission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RolePermission::truncate();
        $permissions = Permission::all();
        $role_permissions = [];
            // role permissions
        foreach($permissions as $per){
            if($per->type === 1){
                $role_id = 1;
            }
            $role_permissions[]  = [
                'role_id'=> $role_id,
                'permission_id'=>$per->id,
            ];
        }

        RolePermission::insert($role_permissions);
    }
}
