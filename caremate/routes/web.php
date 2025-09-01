<?php

use App\Http\Controllers\CartController;
use App\Models\MedicineCatalogue;
use App\Http\Livewire\MedicineCart;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicineCatalogueController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dbconn', function () {
    return view('dbconn');
});

Route::get('/invoice', function () {
    return view('invoice');
});

Route::get('/medicinecatalogue', [MedicineCatalogueController::class, 'index'])->name('home');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');

Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/delete/{id}', [CartController::class, 'delete'])->name('cart.delete');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

