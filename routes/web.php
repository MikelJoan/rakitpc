<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecommendationController;

Route::get('/', [RecommendationController::class, 'index'])->name('home');
Route::get('/rekomendasi', [RecommendationController::class, 'form'])->name('rekomendasi.form');
Route::post('/rekomendasi/proses', [RecommendationController::class, 'proses'])->name('rekomendasi.proses');