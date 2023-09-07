<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $roles = [
            'Superadmin' => [
                'can-add',
                'can-edit',
                'can-delete',
                'can-assign',
                'can-remove',
            ],
            'User' => [],
        ];

        foreach ($roles as $role => $permissions) {
            $role = Role::firstOrCreate(['name' => $role]);
            foreach ($permissions as $permission) {
                Permission::firstOrCreate(['name' => $permission]);

                $role->givePermissionTo($permission);
            }
        }
    }
}
