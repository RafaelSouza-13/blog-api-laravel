<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Auth routes
Route::prefix('auth')->group(function () {
    Route::post('/signup', [AuthController::class, 'signup']);
    Route::post('/signin', [AuthController::class, 'signin']);
    Route::post('/validate', [AuthController::class, 'validate'])->middleware('auth:sanctum');
});

// Rotas públicas
Route::get('/posts', [PostController::class, 'getPosts']);
Route::get('/posts/{slug}', [PostController::class, 'getPost']);
Route::get('/posts/{slug}/related', [PostController::class, 'getRelatedPosts']);

// Rotas privadas
 Route::prefix('admin')->middleware('auth:sanctum')->group(function () {
    Route::get('/posts', [AdminController::class, 'getPosts']);
});
