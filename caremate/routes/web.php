<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dbconn', function(){
    return view('dbconn');
});

Route::get('/invoice', function(){
    return view('invoice');
});

Route::get('/medicinecatalogue', function(){
    return view('medicinecatalogue');
});