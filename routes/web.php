<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');

    Route::livewire('/workers', 'workers')
        ->name('workers.index');
    Route::livewire('/worker/{worker?}', 'workers.show')
        ->name('workers.show');
    Route::livewire('/systems', 'systems')
        ->name('systems.index');
    Route::livewire('/system/{system?}', 'systems.show')
        ->name('systems.show');
    Route::livewire('/projects', 'projects')
        ->name('projects.index');
    Route::livewire('/project/{project?}', 'projects.show')
        ->name('projects.show');
    Route::livewire('/plans', 'plans')
        ->name('plans.index');
    Route::livewire('/plan/{plan?}', 'plans.show')
        ->name('plans.show');
});

require __DIR__.'/settings.php';
