<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ProfileController;

Route::middleware('auth:sanctum')->group(function() {
    
    Route::get('/profile', [ProfileController::class, 'show']);
   
    Route::put('/profile', [ProfileController::class, 'update']);

});