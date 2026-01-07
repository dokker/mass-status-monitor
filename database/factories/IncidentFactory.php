<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\MonitoredSite;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Incident>
 */
class IncidentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $ended_at = fake()->optional(0.2, fake()->dateTimeBetween('-3 hours', 'now'));
        $started_at = fake()->dateTimeBetween('-10 hours', $ended_at ? $ended_at : 'now');
        
        return [
            'monitored_site_id' => MonitoredSite::factory(),
            'started_at' => $started_at,
            'ended_at' => $ended_at,
            'total_downtime_seconds' => $ended_at ? $this->diffInSecond($started_at, $ended_at) : null,
            'notification_sent' => $ended_at ? true : false,
        ];
    }

    protected function diffInSecond($started_at, $ended_at) {
        if (!$started_at || !$ended_at) {
            throw new \InvalidArgumentException('Both start and end times must be provided.');
        }

        try {
            $startCarbon = Carbon::parse($started_at);
            $endCarbon = Carbon::parse($ended_at);
        } catch (\Exception $e) {
            throw new \InvalidArgumentException('Invalid date format provided.');
        }

        return $startCarbon->diffInSeconds($endCarbon);
    }
}
