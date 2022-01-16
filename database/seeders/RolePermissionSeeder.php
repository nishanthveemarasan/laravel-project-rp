<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = config('rolePermission.roles');
        foreach ($roles as $role) {

            $getRole = Role::where('name', $role)->first();


            if ($getRole->name == 'user') {
                $permissions = Permission::whereIn('name', ['view-user', 'edit-user',])->get();
                $getRole->givePermissionTo($permissions);
            }

            if ($getRole->name == 'manager') {
                $permissions = Permission::whereIn('name', ['view-users', 'view-user', 'edit-user',])->get();
                $getRole->givePermissionTo($permissions);
            }
        }
    }
}
