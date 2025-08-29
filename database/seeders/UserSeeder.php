<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure roles exist
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $employeeRole = Role::firstOrCreate(['name' => 'employee']);

        // Create an admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'), // change later
            ]
        );
        $admin->assignRole($adminRole);

        // Create some employees
        foreach (['john@example.com', 'jane@example.com'] as $email) {
            $employee = User::firstOrCreate(
                ['email' => $email],
                [
                    'name' => ucfirst(explode('@', $email)[0]),
                    'password' => Hash::make('password'),
                ]
            );
            $employee->assignRole($employeeRole);
        }
    }
}
