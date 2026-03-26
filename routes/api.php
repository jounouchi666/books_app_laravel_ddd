<?php

use App\Http\Controllers\DbResetController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// デモデータ初期化用
Route::get('/system/db-reset', [DbResetController::class, 'execute'])->name('db_reset');