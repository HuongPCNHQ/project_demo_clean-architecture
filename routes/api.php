<?php

use App\Interfaces\Http\Controllers\Auth\ActiviteController;
use Illuminate\Support\Facades\Route;
use App\Interfaces\Http\Controllers\Auth\RegisterController;
use App\Interfaces\Http\Controllers\Auth\LoginController;


//Auth
// Route::post('/register', function (\Illuminate\Http\Request $request) {
//     dd($request->all());
// });
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/active', [ActiviteController::class, 'active']);
Route::post('/login', [LoginController::class, 'login']);

