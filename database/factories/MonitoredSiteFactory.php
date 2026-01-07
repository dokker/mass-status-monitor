<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MonitoredSite>
 */
class MonitoredSiteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company() . ' Website',
            'url' => fake()->url(),
            'check_interval_minutes' => fake()->numberBetween(1, 15),
            'is_active' => fake()->boolean(),
            'last_status' => fake()->numberBetween(1, 100) <= 80 ? 'up' : 'down',
            'last_checked_at' => fake()->dateTimeBetween('-60 minutes', 'now'),
            'last_response_time_ms' => fake()->numberBetween('100', '2000'),
        ];
    }
}
