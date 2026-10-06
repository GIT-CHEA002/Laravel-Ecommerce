<?php

namespace Database\Seeders;

use App\Models\Role;
use Database\Factories\RoleFactory;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'role_id' => 1,
                'name' => 'Admin',
                'slug' => 'admin',
                'description' => 'Full access to the admin dashboard.',
            ],
            [
                'role_id' => 2,
                'name' => 'Client',
                'slug' => 'client',
                'description' => 'Regular customer account.',
            ],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(['role_id' => $role['role_id']], $role);
        }
    }
}
