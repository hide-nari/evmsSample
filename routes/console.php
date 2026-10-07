<?php

use App\Models\Project;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('init:project', function () {
    Project::all()->each(function ($project) {
        $project->delete();
    });
})->purpose('project_init_sample');

Artisan::command('add:test', function () {
    $file = Storage::get('text.txt');
    $data = explode("\n", $file);
    foreach ($data as $datum) {
        $val = explode(",", $datum);
        foreach ($val as $v) {
            dump($v);
        }
    }
})->purpose('test');

Artisan::command('add:project', function () {
    Project::create([
        'name' => '不具合2(プランがないサンプル)',
        'ticket_number' => 'TBD',
        'system_id' => 1,
        'estimate' => 0.5,
    ]);
})->purpose('project_add_sample');
