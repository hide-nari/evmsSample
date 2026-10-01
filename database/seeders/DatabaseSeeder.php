<?php

namespace Database\Seeders;

use App\Models\Plan;
use App\Models\Project;
use App\Models\System;
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
        ]);
        System::create([
            'name' => 'システムCCC',
        ]);
        System::create([
            'name' => 'システムDDD',
        ]);
        System::create([
            'name' => 'システムEEE',
        ]);

        Project::create([
            'name' => '改修プラン1',
            'mgr_number' => 'MGR001',
            'system_id' => 1,
            'estimate' => 100.0,
        ]);

        Project::create([
            'name' => '改修プラン2',
            'mgr_number' => 'MGR001',
            'system_id' => 1,
            'estimate' => 100.0,
        ]);

        Project::create([
            'name' => '不具合1',
            'mgr_number' => 'TBD',
            'system_id' => 1,
            'estimate' => 100.0,
        ]);

        Plan::create([
            'project_id' => '1',
            'worker_id' => '1',
            'planTime' => 8.0,
            'workDay' => '2026-10-01',
        ]);

        Plan::create([
            'project_id' => '1',
            'worker_id' => '1',
            'planTime' => 8.0,
            'workDay' => '2026-10-02',
        ]);

        Plan::create([
            'project_id' => '1',
            'worker_id' => '1',
            'planTime' => 10.0,
            'workDay' => '2026-10-03',
        ]);
    }
}
