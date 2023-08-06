<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        //Seeding Admin
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(AdminSeeder::class);
        \App\Models\User::factory(100)->create();
        \App\Models\FirStatus::factory(10)->create();
        \App\Models\CasePriority::factory(10)->create();
        \App\Models\IncidentType::factory(10)->create();
        \App\Models\Complainants::factory(20)->create();
        \App\Models\Complain::factory(10)->create();
        \App\Models\Fir::factory(5)->create();
        \App\Models\Witness::factory(10)->create();
        \App\Models\Suspect::factory(10)->create();
        \App\Models\FirToOfficer::factory(10)->create();
        \App\Models\Evidence::factory(10)->create();
    }
}
