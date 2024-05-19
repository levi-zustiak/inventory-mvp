<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        Role::create(['name' => 'company']);
        Role::create(['name' => 'staff']);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@mail.com',
            'password' => 'password'
        ])->assignRole('company');

        User::factory()->create([
            'name' => 'staff',
            'email' => 'staff@mail.com',
            'password' => 'password'
        ])->assignRole('staff');

        Company::factory()
            ->hasCampaigns(2)
            ->create([
                'name' => 'Totle Marketing'
            ]);
    }
}
