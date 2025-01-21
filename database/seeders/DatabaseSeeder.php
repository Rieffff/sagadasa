<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        //    buka comand di bawah untuk memasukan semua user 
        // $this->call(RolePermissionSeeder::class);
        $this->call(ContractorSeeder::class);
        $this->call(MaterialSeeder::class);
        $this->call(LocationSeeder::class);
        $this->call(MaintenanceItemSeeder::class);
        $this->call(DeviceSeeder::class);
    }
}
