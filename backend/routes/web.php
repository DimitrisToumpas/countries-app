<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/api/auth/user', function () {
    return response()->json([
        'authenticated' => true,
        'user' => Auth::guard('auth0-session')->user()
    ]);
})->middleware('auth:auth0-session');
