<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CandidateController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/candidates/{id}', [CandidateController::class, 'getShortInfo']);

// Route::get('/candidates/search', [CandidateController::class, 'search']);
// Route::get('/candidates/{candidate}', [CandidateController::class, 'show']);
