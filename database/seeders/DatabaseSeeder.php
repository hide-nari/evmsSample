<?php

namespace Database\Seeders;

use App\Models\Plan;
use App\Models\Project;
use App\Models\System;
use App\Models\Track;
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
        // master
        Worker::create([
            'name' => '鈴木一郎',
        ]);
        Worker::create([
            'name' => '佐藤二郎',
        ]);
        Worker::create([
            'name' => '石倉三郎',
        ]);
        Worker::create([
            'name' => '伊藤四郎',
        ]);

        Worker::create([
            'name' => '野口五郎',
        ]);

        System::create([
            'name' => 'システムAAA',
            'worker_id' => 5,
        ]);
        System::create([
            'name' => 'システムBBB',
            'worker_id' => 5,
        ]);
        System::create([
            'name' => 'システムCCC',
        ]);

        // transaction project
        Project::create([
            'name' => '改修プラン1(CPI1以上のサンプル)',
            'ticket_number' => '123',
            'system_id' => 1,
            'estimate' => 0.5,
        ]);

        Project::create([
            'name' => '改修プラン2(CPI1のサンプル)',
            'ticket_number' => '456',
            'system_id' => 1,
            'estimate' => 0.3,
        ]);

        Project::create([
            'name' => '改修プラン3(CPI1以下のサンプル)',
            'ticket_number' => '789',
            'system_id' => 1,
            'estimate' => 0.2,
        ]);

        Project::create([
            'name' => '不具合1(プランがないサンプル)',
            'ticket_number' => 'TBD',
            'system_id' => 1,
            'estimate' => 0.1,
        ]);

        // transaction plan 1
        Plan::create([
            'project_id' => '1',
            'worker_id' => '1',
            'planTime' => 10.0,
            'workDay' => '2026-10-01',
        ]);

        Plan::create([
            'project_id' => '1',
            'worker_id' => '1',
            'planTime' => 20.0,
            'workDay' => '2026-10-05',
        ]);

        Plan::create([
            'project_id' => '1',
            'worker_id' => '1',
            'planTime' => 20.0,
            'workDay' => '2026-10-12',
        ]);

        Plan::create([
            'project_id' => '1',
            'worker_id' => '1',
            'planTime' => 10.0,
            'workDay' => '2026-10-19',
        ]);


        // transaction plan 2
        Plan::create([
            'project_id' => '1',
            'worker_id' => '2',
            'planTime' => 10.0,
            'workDay' => '2026-10-19',
        ]);

        Plan::create([
            'project_id' => '2',
            'worker_id' => '3',
            'planTime' => 10,
            'workDay' => '2026-10-01',
        ]);

        Plan::create([
            'project_id' => '2',
            'worker_id' => '3',
            'planTime' => 20,
            'workDay' => '2026-10-05',
        ]);

        Plan::create([
            'project_id' => '2',
            'worker_id' => '3',
            'planTime' => 12,
            'workDay' => '2026-10-12',
        ]);

        // transaction plan 3
        Plan::create([
            'project_id' => '3',
            'worker_id' => '4',
            'planTime' => 28.0,
            'workDay' => '2026-10-05',
        ]);

        // transaction track 1
        Track::create([
            'project_id' => '1',
            'worker_id' => '1',
            'workTime' => 5.0,
            'workDay' => '2026-10-01',
        ]);

        Track::create([
            'project_id' => '1',
            'worker_id' => '1',
            'workTime' => 5.0,
            'workDay' => '2026-10-02',
        ]);

        Track::create([
            'project_id' => '1',
            'worker_id' => '1',
            'workTime' => 8.0,
            'workDay' => '2026-10-05',
        ]);

        Track::create([
            'project_id' => '1',
            'worker_id' => '1',
            'workTime' => 8.0,
            'workDay' => '2026-10-06',
        ]);

        Track::create([
            'project_id' => '1',
            'worker_id' => '1',
            'workTime' => 8.0,
            'workDay' => '2026-10-07',
        ]);

        Track::create([
            'project_id' => '1',
            'worker_id' => '1',
            'workTime' => 8.0,
            'workDay' => '2026-10-08',
        ]);

        Track::create([
            'project_id' => '1',
            'worker_id' => '1',
            'workTime' => 5.0,
            'workDay' => '2026-10-09',
        ]);

        Track::create([
            'project_id' => '1',
            'worker_id' => '1',
            'workTime' => 3.0,
            'workDay' => '2026-10-13',
        ]);


        // transaction track 2
        Track::create([
            'project_id' => '2',
            'worker_id' => '3',
            'workTime' => 5.0,
            'workDay' => '2026-10-01',
        ]);

        Track::create([
            'project_id' => '2',
            'worker_id' => '3',
            'workTime' => 8.0,
            'workDay' => '2026-10-02',
        ]);

        Track::create([
            'project_id' => '2',
            'worker_id' => '3',
            'workTime' => 7.0,
            'workDay' => '2026-10-05',
        ]);

        Track::create([
            'project_id' => '2',
            'worker_id' => '3',
            'workTime' => 7.0,
            'workDay' => '2026-10-06',
        ]);

        Track::create([
            'project_id' => '2',
            'worker_id' => '3',
            'workTime' => 7.0,
            'workDay' => '2026-10-07',
        ]);

        Track::create([
            'project_id' => '2',
            'worker_id' => '3',
            'workTime' => 5.0,
            'workDay' => '2026-10-08',
        ]);

        Track::create([
            'project_id' => '2',
            'worker_id' => '3',
            'workTime' => 3.0,
            'workDay' => '2026-10-13',
        ]);

        // transaction track 3
        Track::create([
            'project_id' => '3',
            'worker_id' => '4',
            'workTime' => 8.0,
            'workDay' => '2026-10-05',
        ]);

        Track::create([
            'project_id' => '3',
            'worker_id' => '4',
            'workTime' => 8.0,
            'workDay' => '2026-10-06',
        ]);

        Track::create([
            'project_id' => '3',
            'worker_id' => '4',
            'workTime' => 8.0,
            'workDay' => '2026-10-07',
        ]);

        Track::create([
            'project_id' => '3',
            'worker_id' => '4',
            'workTime' => 8.0,
            'workDay' => '2026-10-08',
        ]);

        Track::create([
            'project_id' => '3',
            'worker_id' => '4',
            'workTime' => 8.0,
            'workDay' => '2026-10-09',
        ]);

        // transaction track 4
        Track::create([
            'project_id' => '4',
            'worker_id' => '2',
            'workTime' => 8.0,
            'workDay' => '2026-10-05',
        ]);

        Track::create([
            'project_id' => '4',
            'worker_id' => '2',
            'workTime' => 8.0,
            'workDay' => '2026-10-06',
        ]);

        Track::create([
            'project_id' => '4',
            'worker_id' => '2',
            'workTime' => 8.0,
            'workDay' => '2026-10-07',
        ]);

        // transaction no plan track
        Track::create([
            'project_id' => '0',
            'worker_id' => '2',
            'workTime' => 8.0,
            'workDay' => '2026-10-13',
        ]);

        Track::create([
            'project_id' => '0',
            'worker_id' => '2',
            'workTime' => 8.0,
            'workDay' => '2026-10-14',
        ]);

        Track::create([
            'project_id' => '0',
            'worker_id' => '2',
            'workTime' => 8.0,
            'workDay' => '2026-10-15',
        ]);
    }
}
