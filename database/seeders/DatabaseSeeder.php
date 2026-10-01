<?php

namespace Database\Seeders;

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
    }
}
