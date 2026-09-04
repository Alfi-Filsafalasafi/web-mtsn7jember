<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\WadulGusDarController;
use App\Http\Controllers\ZonaIntegritasController;
use App\Http\Controllers\LiterasiController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profil', [ProfileController::class, 'index'])->name('profile');
Route::get('/berita', [ArticleController::class, 'index'])->name('articles');
Route::get('/berita/{slug}', [ArticleController::class, 'show'])->name('articles.show');
Route::get('/guru-staf', [TeacherController::class, 'index'])->name('teachers');
Route::get('/kontak', [ContactController::class, 'index'])->name('contact');
Route::post('/kontak', [ContactController::class, 'store'])->name('contact.store');
Route::get('/layanan-legalisir', [LayananController::class, 'legalisir'])->name('layanan.legalisir');
Route::get('/layanan-mutasi', [LayananController::class, 'mutasi'])->name('layanan.mutasi');



Route::get('/literasi', [LiterasiController::class, 'index'])->name('literasi');
Route::get('/literasi/upload', [LiterasiController::class, 'create'])->name('literasi.create');
Route::post('/literasi/upload', [LiterasiController::class, 'store'])->name('literasi.store');
Route::get('/literasi/{literasi:slug}', [LiterasiController::class, 'show'])->name('literasi.show');

Route::get('/wadul-gusdar', [WadulGusDarController::class, 'create'])->name('wadul-gusdar.create');
Route::post('/wadul-gusdar', [WadulGusDarController::class, 'store'])->name('wadul-gusdar.store');


Route::get('/zona-integritas/evidence-zi', [ZonaIntegritasController::class, 'evidence'])->name('zona-integritas.evidence');
Route::get('/zona-integritas/laporan-laporan', [ZonaIntegritasController::class, 'laporan'])->name('zona-integritas.laporan');
Route::get('/zona-integritas/survei', [ZonaIntegritasController::class, 'survei'])->name('zona-integritas.survei');
