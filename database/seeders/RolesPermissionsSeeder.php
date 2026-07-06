<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissionsConfig = config('role.permissions');

        // Create all permissions
        foreach ($permissionsConfig as $role => $resources) {
            foreach ($resources as $resource => $actions) {
                if (! is_array($actions)) {
                    continue;
                }
                foreach ($actions as $action) {
                    Permission::firstOrCreate(['name' => "{$resource}.{$action}"]);
                }
            }
        }

        // Create roles and assign permissions
        foreach ($permissionsConfig as $role => $resources) {
            $roleModel = Role::firstOrCreate(['name' => $role]);
            $roleModel->syncPermissions([]);

            foreach ($resources as $resource => $actions) {
                if (! is_array($actions)) {
                    continue;
                }
                foreach ($actions as $action) {
                    $permission = Permission::where('name', "{$resource}.{$action}")->first();
                    if ($permission) {
                        $roleModel->givePermissionTo($permission);
                    }
                }
            }
        }
    }
}
