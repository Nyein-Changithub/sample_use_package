<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/images', [ImageController::class, 'index'])->name('images.index');
Route::get('/images/create', [ImageController::class, 'create'])->name('images.create');
Route::post('/images', [ImageController::class, 'store'])->name('images.store');
Route::delete('/images/{id}', [ImageController::class, 'destroy'])->name('images.destroy');
