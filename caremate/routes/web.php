<?php

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

Route::get('/medicinecatalogue', [MedicineCatalogueController::class, 'index']);


