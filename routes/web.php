<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.Frontend.Pages.home');
});

//Auth

Route::get('/login', function () {
    return view('layouts.Auth.Pages.login');
});
Route::get('/register', function () {
    return view('layouts.Auth.Pages.register');
});
Route::get('/forgot-password', function () {
    return view('layouts.Auth.Pages.forgot-password');
});
Route::get('/reset-password', function () {
    return view('layouts.Auth.Pages.reset-password');
});
Route::get('/verify-otp', function () {
    return view('layouts.Auth.Pages.verify-otp');
});

Route::get('/verify-2fa', function () {
    return view('layouts.Auth.Pages.verify-2fa');
});

//Frontend
Route::get('/home', function () {
    return view('layouts.Frontend.Pages.home');
});
Route::get('/showqr', function () {
    return view('layouts.Frontend.Pages.showqr');
});
Route::get('/change-password', function () {
    return view('layouts.Frontend.Pages.change-password');
});
Route::get('/information', function () {
    return view('layouts.Frontend.Pages.information');
});


//Admin
Route::get('/admin/dashboard', function () {
    return view('layouts.Admin.Pages.dashboard');
});
Route::get('/admin/information', function () {
    return view('layouts.Admin.Pages.information');
});
Route::get('/admin/change-password', function () {
    return view('layouts.Admin.Pages.change-password');
});
Route::get('/admin/list-user', function () {
    return view('layouts.Admin.Pages.list-user');
});
Route::get('/admin/add-user', function () {
    return view('layouts.Admin.Pages.add-user');
});
Route::get('/admin/edit-user', function () {
    return view('layouts.Admin.Pages.edit-user');
});