<?php

use Illuminate\Support\Facades\Route;

// Landing page
Route::view('/', 'site.index');

// Ruta para pruebas
Route::get('tests', function () { 
    return view("tests");
});