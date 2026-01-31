<?php

use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

/* NOTE: Do Not Remove
/ Livewire asset handling if using sub folder in domain
*/
Livewire::setUpdateRoute(function ($handle) {
    return Route::post(config('app.asset_prefix') . '/livewire/update', $handle);
});

Livewire::setScriptRoute(function ($handle) {
    return Route::get(config('app.asset_prefix') . '/livewire/livewire.js', $handle);
});
/*
/ END
*/
Route::get('/', function () {
    return view('pages.app');
})->name('home');

Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Route::get('/services', function () {
    return view('pages.services');
})->name('services');

Route::get('/pricing', function () {
    return view('pages.pricing');
})->name('pricing');

Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');

Route::get('/get-a-quote', function () {
    return view('pages.get-a-quote');
})->name('get-a-quote');

Route::get('/service-details', function () {
    return view('pages.service-details');
})->name('service-details');

Route::get('/products', function () {
    return view('pages.products');
})->name('products');

Route::get('/categories', function () {
    return view('pages.categories');
})->name('categories');

// Invoice PDF Routes
Route::middleware('auth')->group(function () {
    Route::get('/invoice/{invoice}/download', [App\Http\Controllers\InvoicePdfController::class, 'download'])
        ->name('invoice.download');
    Route::get('/invoice/{invoice}/stream', [App\Http\Controllers\InvoicePdfController::class, 'stream'])
        ->name('invoice.stream');
});
