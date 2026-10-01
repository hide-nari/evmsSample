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
});

require __DIR__.'/settings.php';
