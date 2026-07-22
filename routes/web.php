<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecommendationController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ComponentController;

Route::get('/', [RecommendationController::class, 'index'])->name('home');
Route::get('/rekomendasi', [RecommendationController::class, 'form'])->name('rekomendasi.form');
Route::post('/rekomendasi/proses', [RecommendationController::class, 'proses'])->name('rekomendasi.proses');

Route::get('/lang/{locale}', function ($locale) {
    session(['locale' => in_array($locale, ['id', 'en']) ? $locale : 'id']);
    $previousUrl = url()->previous();
    if (str_contains($previousUrl, 'rekomendasi/proses')) {
        return redirect()->route('home');
    }
    return redirect($previousUrl);
})->name('lang.switch');

// Admin routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminController::class, 'loginForm'])->name('login');
    Route::post('/login', [AdminController::class, 'login'])->name('login.submit');

    Route::middleware('admin')->group(function () {
        Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        Route::get('/{kategori}', [ComponentController::class, 'index'])->name('components.index');
        Route::get('/{kategori}/create', [ComponentController::class, 'create'])->name('components.create');
        Route::post('/{kategori}', [ComponentController::class, 'store'])->name('components.store');
        Route::get('/{kategori}/{id}/edit', [ComponentController::class, 'edit'])->name('components.edit');
        Route::put('/{kategori}/{id}', [ComponentController::class, 'update'])->name('components.update');
        Route::delete('/{kategori}/{id}', [ComponentController::class, 'destroy'])->name('components.destroy');
    });
});
