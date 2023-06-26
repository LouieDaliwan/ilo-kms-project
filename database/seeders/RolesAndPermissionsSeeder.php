<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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
                'can-approve',
                'can-comment',
                'can-remove'
            ],
            'D-Group-Leader' => [
                'can-accept',
                'can-comment',
                'can-update',
                'can-remove'
            ],
            'Member' => []
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