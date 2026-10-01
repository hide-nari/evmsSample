<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');

    Route::livewire('/workers', 'workers')
        ->name('workers.index');
    Route::livewire('/worker/{workers?}', 'workers.show')
        ->name('workers.show');
});

require __DIR__.'/settings.php';
