<?php

use App\Interfaces\Http\Controllers\Auth\ActiviteController;
use App\Interfaces\Http\Controllers\Auth\ForgotPassController;
use Illuminate\Support\Facades\Route;
use App\Interfaces\Http\Controllers\Auth\RegisterController;
use App\Interfaces\Http\Controllers\Auth\LoginController;
use App\Interfaces\Http\Controllers\Frontend\ChangePasswordController;
use App\Interfaces\Http\Controllers\Frontend\ShowInforController;
use App\Interfaces\Http\Controllers\Frontend\UpdateInforController;
use App\Interfaces\Http\Controllers\Admin\UserController;
use App\Interfaces\Http\Controllers\Auth\TwoFactorController;

//Auth
// Route::post('/register', function (\Illuminate\Http\Request $request) {
//     dd($request->all());
// });
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/active', [ActiviteController::class, 'active']);
Route::post('/login', [LoginController::class, 'login']);
Route::post('/forgot-password', [ForgotPassController::class, 'forgotPassword']);
Route::post('/reset-password', [ForgotPassController::class, 'ResetPassword']);
Route::post('/2fa/enable', [TwoFactorController::class, 'enable'])->name('2fa.enable');
Route::post('/2fa/disable', [TwoFactorController::class, 'disable'])->name('2fa.disable');
Route::post('/2fa/verify', [TwoFactorController::class, 'verify'])->name('2fa.verify');

//Frontend
Route::get('/show-infor/{id}', [ShowInforController::class, 'showInfor']);
Route::put('/update-infor/{id}', [UpdateInforController::class, 'updateInfor']);
Route::post('/change-password/{id}', [ChangePasswordController::class, 'changePassword']);


//Admin
Route::get('/get-user/{id}', [UserController::class, 'getUserById']);
Route::post('/add-user', [UserController::class, 'addUser']);
Route::get('/list-user', [UserController::class, 'listUser']);
Route::get('/list-user/role/{role}', [UserController::class, 'listUserByRole']);
Route::get('/list-user/active/{isActive}', [UserController::class, 'listUserByIsActive']);
Route::get('/list-user/lock/{isLock}', [UserController::class, 'listUserByIsLock']);
Route::put('/update-user/{id}', [UserController::class, 'updateUser']);
Route::put('/lock-user/{id}', [UserController::class, 'lockUser']);
Route::delete('/delete-user/{id}', [UserController::class, 'removeUser']);
Route::put('/lock-unlock/{id}', [UserController::class, 'lockAndUnlock']);


