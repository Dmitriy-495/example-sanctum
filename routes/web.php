<?php

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\RegisterUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return response([
        'message' => 'Вы уже находитесь в системе'
    ], Response::HTTP_UNPROCESSABLE_ENTITY);
});

Route::post('/register',[RegisterUserController::class, 'store'])->middleware('guest');

Route::delete('/delete-account',[RegisterUserController::class, 'destroy'])->middleware('auth');

Route::post('/login',[AuthenticatedSessionController::class, 'store'])->middleware('guest');

Route::delete('/logout',[AuthenticatedSessionController::class, 'destroy'])->middleware('auth');
