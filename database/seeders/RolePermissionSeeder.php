<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Daftar permissions
        $permissions = [
            'manage users',   // Untuk admin
            'add master data',   // Untuk admin
            'edit master data',   // Untuk admin
            'delete master data',   // Untuk admin
            'view master data',   // Untuk admin
            'add activity',   
            'edit activity',   
            'delete activity',   
            'view activity',   
           
        ];

        // Buat permissions
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Buat roles dan tetapkan permissions
        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo($permissions); // Admin mendapatkan semua permissions

        $supervisor = Role::create(['name' => 'supervisor']);
        $supervisor->givePermissionTo($permissions); // Admin mendapatkan semua permissions

        $technician = Role::create(['name' => 'technician']);
        $technician->givePermissionTo('view master data', 'view activity', 'add activity','edit activity','delete activity'); // technician hanya memiliki permission "process sales"

        // Buat user contoh
        $users = [
            [
                'name' => '02 Admin',
                'email' => 'mmaarif0306@gmai.com',
                'password' => Hash::make('tohawi'),
                'role' => 'admin',
                'position' => 'Developer',
                'contact' => '+86',
            ],
            [
                'name' => 'Admin',
                'email' => 'Admin@gmail.com',
                'password' => Hash::make('kopihitam123'),
                'role' => 'admin',
                'position' => 'Admin',
                'contact' => '+62564648135',
            ],
            [
                'name' => 'Supervisor',
                'email' => 'di@gmail.com',
                'password' => Hash::make('weng'),
                'role' => 'supervisor',
                'position' => 'Supervisor',
                'contact' => '+62',
            ],
            [
                'name' => 'Supervisor',
                'email' => 'dii@gmail.com',
                'password' => Hash::make('weng'),
                'role' => 'supervisor',
                'position' => 'Supervisor',
                'contact' => '+6288',
            ],
            [
                'name' => 'Rosidi technician',
                'email' => 'diii@gmail.com',
                'password' => Hash::make('weng'),
                'role' => 'technician',
                'position' => 'Technician',
                'contact' => '+86',
            ],
        ];

        // Buat user dan tetapkan role
        foreach ($users as $userData) {
            $user = User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => $userData['password'],
                'role' => $userData['role'],
                'position' => $userData['position'],
                'contact' => $userData['contact'],
            ]);
            $user->assignRole($userData['role']); // Tetapkan role ke user
        }

        // Pesan sukses
        $this->command->info('Roles, permissions, dan users berhasil dibuat!');
    }
}
