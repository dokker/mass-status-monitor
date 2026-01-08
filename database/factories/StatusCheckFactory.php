<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\MonitoredSite;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StatusCheck>
 */
class StatusCheckFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = fake()->numberBetween(1, 100) <= 95 ? 'up' : 'down';

        return [
            'monitored_site_id' => MonitoredSite::factory(),
            'status' => $status,
            'response_time_ms' => fake()->numberBetween(50, 3000),
            'http_status_code' => $this->getErrorCode($status),
            'error_message' => $status == 'up' ? null : fake()->sentence(),
            'checked_at' => fake()->dateTimeBetween('-10 hours', 'now'),
        ];
    }

    protected function getErrorCode($status) : int {
        $error_codes = [500, 503, 404];
        
        if ($status == 'up') {
            return 200;
        } else {
            return $error_codes[fake()->numberBetween(0, 2)];
        }
    }
}
