<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
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
        $guard = config('rolePermission.guard_name');
        foreach ($permissions as $permission) {

            Permission::create([
                'name' => $permission,
                'guard_name' => $guard
            ]);
        }
    }
}
