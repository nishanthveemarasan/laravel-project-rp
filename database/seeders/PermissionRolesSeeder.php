<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = config('role.permissions');
        $types = config('role.types');
        $guard = config('role.guard_name');
        $roles = config('role.roles');
        unset($roles[1]);
        foreach ($permissions as $permission) {
            foreach ($types as $type) {
                $permission = Permission::firstOrCreate([
                    'name' => $permission . " " . $type,
                    'guard_name' => $guard
                ]);
                foreach ($roles as $role) {
                    $permission->assignRole($role);
                }
            }
        }
    }
}
