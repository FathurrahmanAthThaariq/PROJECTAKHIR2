<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'admin',
                'guard_name' => 'web'
            ],
            [
                'name' => 'manager',
                'guard_name' => 'web'
            ],
            [
                'name' => 'user',
                'guard_name' => 'web'
            ],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }

        $permissions = [
            [
                'name' => 'create',
                'guard_name' => 'web'
            ],
            [
                'name' => 'read',
                'guard_name' => 'web'
            ],
            [
                'name' => 'update',
                'guard_name' => 'web'
            ],
            [
                'name' => 'delete',
                'guard_name' => 'web'
            ],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }

        $role = Role::findByName('admin');
        $role->givePermissionTo('create');
        $role->givePermissionTo('read');
        $role->givePermissionTo('update');
        $role->givePermissionTo('delete');

        $role = Role::findByName('manager');
        $role->givePermissionTo('create');
        $role->givePermissionTo('read');
        $role->givePermissionTo('update');
        $role->givePermissionTo('delete');

        $role = Role::findByName('user');
        $role->givePermissionTo('read');
    }
}
