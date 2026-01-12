<?php

use App\Livewire\Dashboard\DocumentSection;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth', 'verified'])
    ->prefix('dashboard')
    ->name('dashboard.')
    ->group(
        function () {

            Route::get('/document', DocumentSection::class)->name('document');
        }
    );

require __DIR__ . '/settings.php';
