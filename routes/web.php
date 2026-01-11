<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin
    Route::prefix('/admin')->name('admin.')->middleware(AdminMiddleware::class)->group(function() {
        Route::get('/', [AdminController::class, 'index'])->name('index');

        // Categories
        Route::prefix('/categories')->name('categories.')->group(function() {
            Route::get('/', [CategoryController::class, 'list'])->name('list');
            Route::get('/create', [CategoryController::class, 'create'])->name('create');
            Route::get('/{id}/edit', [CategoryController::class, 'edit'])->name('edit');

            Route::post('/store', [CategoryController::class, 'store'])->name('store');
            Route::patch('/{id}/update', [CategoryController::class, 'update'])->name('update');
            Route::delete('/{id}/delete', [CategoryController::class, 'delete'])->name('delete');
       });
    });

    // Books
    Route::prefix('/books')->name('books.')->group(function() {
        Route::get('/', [BookController::class, 'index'])->name('index');
        Route::get('/create', [BookController::class, 'create'])->name('create');
        Route::get('/{id}', [BookController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [BookController::class, 'edit'])->name('edit');

        Route::post('/store', [BookController::class, 'store'])->name('store');
        Route::patch('/{id}/update', [BookController::class, 'update'])->name('update');
        Route::delete('/{id}/delete', [BookController::class, 'delete'])->name('delete');
    });
});

require __DIR__.'/auth.php';
