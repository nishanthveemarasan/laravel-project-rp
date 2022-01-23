<?php

namespace App\Services;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionService
{

    public function addPermission($data)
    {
        foreach ($data['roles'] as $role) {
            foreach ($data['permissions'] as $permission) {
                $assignPermission = $this->createPermission($permission);
                $assignPermission->assignRole($role);
            }
        }
        return ['message' => 'Permissions have been added successfully!!'];
    }

    public function removePermission($data)
    {
        foreach ($data['roles'] as $role) {
            foreach ($data['permissions'] as $permission) {
                $assignPermission = $this->createPermission($permission);
                $assignPermission->removeRole($role);
            }
        }
        return ['message' => 'Permissions have been updated successfully!!'];
    }

    public function createPermission($permission)
    {
        return Permission::firstOrCreate([
            'name' => $permission,
            'guard_name' => config('role.guard_name')
        ]);
    }
}
