<?php

namespace Database\Seeders;

use App\Enums\Roles;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    const ADMIN_EMAIL = 'admin@admin.com';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!User::where('email', self::ADMIN_EMAIL)->exists()) {
            $admin = User::factory()->withEmail(self::ADMIN_EMAIL)->create();
            $admin->syncRoles(Roles::ADMIN->value);
        }
        User::factory(5)->create();
    }
}
