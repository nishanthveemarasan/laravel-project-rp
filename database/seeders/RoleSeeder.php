<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
<<<<<<< HEAD
        $roles = config('rolePermission.roles');
        $guard = config('rolePermission.guard_name');
=======
        $roles = config('role.roles');
        $guard = config('role.guard_name');
>>>>>>> manage-product
        foreach ($roles as $role) {

            Role::create([
                'name' => $role,
                'guard_name' => $guard
            ]);
        }
    }
}
