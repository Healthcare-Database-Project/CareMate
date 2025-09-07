<?php

use App\Models\MedicineCatalogue;
use App\Http\Livewire\MedicineCart;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\LoginController;
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


Route::get('/login', function(){
    return view('login.userlogin');
})->name('login');

Route::post('login', LoginController::class)->name('login.attempt');

// ...existing code...
Route::get('/signup', function(){
    return view('login.signup');
})->name('signup');

Route::post('/signup', [App\Http\Controllers\SignupController::class, 'store'])->name('signup.attempt');
// ...existing code...

Route::get('/userdashboard', function(){
    return view('user.userdashboard');
})->name('userdashboard');

Route::get('/admindashboard', function(){
    return view('admin.admindashboard');
})->name('admindashboard');

Route::get('/doctordashboard', function(){
    return view('doctor.doctordashboard');
})->name('doctordashboard');



