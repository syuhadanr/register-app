<?php
use App\Http\Controllers\API\APIController;


Route::get('/users', [APIController::class, 'index']);
Route::get('/users', [APIController::class, 'apiIndex']);
Route::post('/users', [APIController::class, 'apiStore']);
Route::get('/users/{id}', [APIController::class, 'apiShow']);
Route::put('/users/{id}', [APIController::class, 'apiUpdate']);
Route::delete('/users/{id}', [APIController::class, 'apiDestroy']);
