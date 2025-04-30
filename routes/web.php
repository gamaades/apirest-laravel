<?php

// use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
    //     return view('welcome');
    // });

use App\Http\Controllers\ClienteController;

// Route::get('/', [ClienteController::class, 'index']);
// reuuta que incluyen todos los metodos de la clase
Route::resource('/', ClienteController::class);
Route::resource('/registro', ClienteController::class);

