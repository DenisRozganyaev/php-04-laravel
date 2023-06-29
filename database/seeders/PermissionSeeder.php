<?php

namespace Database\Seeders;

use App\Enums\Roles;
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
                Permission::findOrCreate($permission);
            }
        }

        // Customer
        if (!Role::where('name', Roles::CUSTOMER->value)->exists()) {
            $role = Role::create(['name' => Roles::CUSTOMER->value]);
            $role->givePermissionTo(array_values($access['account']));
        }

        if (!Role::where('name', Roles::MODERATOR->value)->exists()) {
            $moderatorRoles = array_merge(
                array_values($access['categories']),
                array_values($access['products'])
            );
            $role = Role::create(['name' => Roles::MODERATOR->value])
                ->givePermissionTo($moderatorRoles);
        }
        if (!Role::where('name', Roles::ADMIN->value)->exists()) {
            $role = Role::create(['name' => Roles::ADMIN->value]);
            $role->givePermissionTo(Permission::all());
        }
    }
}
