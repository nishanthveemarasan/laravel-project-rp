<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = config('rolePermission.permissions');
        $types = config('rolePermission.types');
        $guard = config('rolePermission.guard_name');

        $roles = Role::all();
        foreach ($permissions as $permission) {
            foreach ($types as $type) {
                $permission = Permission::firstOrCreate([
                    'name' => $permission . " " . $type,
                    'guard_name' => $guard
                ]);
                foreach ($roles as $role) {
                    if ($role != 'admin') {
                        $permission->assignRole($role);
                    }
                }
            }
        }
    }
}
