<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ContactController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profil', [ProfileController::class, 'index'])->name('profile');
Route::get('/berita', [ArticleController::class, 'index'])->name('articles');
Route::get('/berita/{slug}', [ArticleController::class, 'show'])->name('articles.show');
Route::get('/guru-staf', [TeacherController::class, 'index'])->name('teachers');
Route::get('/kontak', [ContactController::class, 'index'])->name('contact');
Route::post('/kontak', [ContactController::class, 'store'])->name('contact.store');
