<?php

namespace Database\Seeders;

use App\Models\Plan;
use App\Models\Project;
use App\Models\System;
use App\Models\Track;
use App\Models\User;
use App\Models\Worker;
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

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Worker::create([
            'name' => '鈴木一郎',
        ]);
        Worker::create([
            'name' => '鈴木二郎',
        ]);
        Worker::create([
            'name' => '鈴木三郎',
        ]);
        Worker::create([
            'name' => '鈴木四郎',
        ]);
        Worker::create([
            'name' => '鈴木五郎',
        ]);

        System::create([
            'name' => 'システムAAA',
            'worker_id' => 1,
        ]);
        System::create([
            'name' => 'システムBBB',
            'worker_id' => 1,
        ]);
        System::create([
            'name' => 'システムCCC',
            'worker_id' => 1,
        ]);
        System::create([
            'name' => 'システムDDD',
            'worker_id' => 2,
        ]);
        System::create([
            'name' => 'システムEEE',
            'worker_id' => 2,
        ]);

        Project::create([
            'name' => '改修プラン1',
            'ticket_number' => '123',
            'system_id' => 1,
            'estimate' => 0.3,
        ]);

        Project::create([
            'name' => '改修プラン2',
            'ticket_number' => '456',
            'system_id' => 1,
            'estimate' => 0.24,
        ]);

        Project::create([
            'name' => '不具合1',
            'ticket_number' => 'TBD',
            'system_id' => 1,
            'estimate' => 0.5,
        ]);

        Plan::create([
            'project_id' => '1',
            'worker_id' => '1',
            'planTime' => 1.0,
            'workDay' => '2026-09-21',
        ]);

        Plan::create([
            'project_id' => '1',
            'worker_id' => '1',
            'planTime' => 2.0,
            'workDay' => '2026-09-28',
        ]);

        Plan::create([
            'project_id' => '2',
            'worker_id' => '2',
            'planTime' => 2.5,
            'workDay' => '2026-09-21',
        ]);

        Plan::create([
            'project_id' => '2',
            'worker_id' => '2',
            'planTime' => 1.0,
            'workDay' => '2026-09-28',
        ]);

        Track::create([
            'project_id' => '1',
            'worker_id' => '1',
            'workTime' => 1.0,
            'workDay' => '2026-09-21',
        ]);

        Track::create([
            'project_id' => '1',
            'worker_id' => '1',
            'workTime' => 2.0,
            'workDay' => '2026-09-28',
        ]);

        Track::create([
            'project_id' => '2',
            'worker_id' => '2',
            'workTime' => 2.5,
            'workDay' => '2026-09-21',
        ]);

        Track::create([
            'project_id' => '2',
            'worker_id' => '2',
            'workTime' => 1.0,
            'workDay' => '2026-09-28',
        ]);
    }
}
