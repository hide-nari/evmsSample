<?php

namespace Database\Factories;

use App\Models\Plan;
use App\Models\Project;
use App\Models\Worker;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends Factory<Plan>
 */
class PlanFactory extends Factory
{
    protected $model = Plan::class;

    public function definition(): array
    {
        return [
            'planTime' => $this->faker->randomFloat(),
            'workDay' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'project_id' => Project::factory(),
            'worker_id' => Worker::factory(),
        ];
    }
}
