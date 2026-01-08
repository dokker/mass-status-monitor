<?php

namespace Database\Seeders;

use App\Models\MonitoredSite;
use App\Models\StatusCheck;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        MonitoredSite::factory()
            ->count(10)
            ->has(StatusCheck::factory()->count(50))
            ->create();
    }
}
