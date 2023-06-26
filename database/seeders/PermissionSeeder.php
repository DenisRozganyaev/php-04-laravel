<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $access = config('permission.access');

        foreach ($access as $type) {
            foreach ($type as $permission) {
                Permission::create(['name' => $permission]);
            }
        }

        // Customer
        $role = Role::create(['name' => 'customer']);
        $role->givePermissionTo(array_values($access['account']));
        // or may be done by chaining

        $moderatorRoles = array_merge(
            array_values($access['categories']),
            array_values($access['products'])
        );
        $role = Role::create(['name' => 'moderator'])->givePermissionTo($moderatorRoles);

        $role = Role::create(['name' => 'super-admin']);
        $role->givePermissionTo(Permission::all());
    }
}
