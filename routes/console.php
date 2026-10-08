<?php

use App\Imports\ProjectImport;
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
    $projectInputData = Excel::toArray(new ProjectImport, 'testOne.xlsx');
    foreach ($projectInputData as $sheet) {
        foreach ($sheet as $row) {
            $resultStr = '';
            for ($i = 0; $i < count($row); $i++) {
                $resultStr .= $row[$i] . ',';
            }
            Storage::append('/data/projects.txt', $resultStr);
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
