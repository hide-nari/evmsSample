<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\Track;
use App\Models\Worker;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends Factory<Track>
 */
class TrackFactory extends Factory
{
    protected $model = Track::class;

    public function definition(): array
    {
        return [
            'workTime' => $this->faker->randomFloat(),
            'WorkDay' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'project_id' => Project::factory(),
            'worker_id' => Worker::factory(),
        ];
    }
}
