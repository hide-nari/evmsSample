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

Artisan::command('add:projects', function () {
    $projectInputData = Excel::toArray(new ProjectImport, 'projects.xlsx');
    foreach ($projectInputData as $sheet) {
        foreach ($sheet as $row) {
            $resultStr = '';
            for ($i = 0; $i < count($row); $i++) {
                $resultStr .= $row[$i] . ',';
            }
            Storage::append('/tra/projects.txt', $resultStr);
        }
    }
})->purpose('import excel project data');
