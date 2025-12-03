<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class RoleAndAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create Roles
        $roles = ['Admin', 'Teacher', 'Student', 'Parent'];
        
        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }

        // Create Admin User
        $user = User::create([
            'name' => 'Admin User',
            'email' => 'admin@school.com',
            'password' => Hash::make('password'),
        ]);

        // Assign Admin Role
        $user->assignRole('Admin');
    }
}
