<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/users', [UserController::class, 'apiIndex']);      // Get all users
Route::post('/users', [UserController::class, 'apiStore']);      // Create a user
Route::get('/users/{id}', [UserController::class, 'apiShow']);   // Get a single user
Route::put('/users/{id}', [UserController::class, 'apiUpdate']); // Update a user
Route::delete('/users/{id}', [UserController::class, 'apiDestroy']); // Delete a user

