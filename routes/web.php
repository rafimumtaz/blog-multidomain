<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Auth\LoginController;

// Rute Login Terpusat (Global)
Route::get('/', function () {
    return view('welcome'); // Arahkan ke halaman selamat datang atau halaman login
});
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');


// Rute per Institusi
Route::pattern('institution', '[a-z0-9\-]+');
Route::pattern('article', '[0-9]+');

Route::domain('{institution}.localhost')->middleware('auth')->group(function () {
    Route::get('/', function ($institution) {
        // Pastikan pengguna hanya bisa akses domain institusinya
        if (auth()->user()->institution->subdomain !== $institution) {
            abort(403, 'Akses Ditolak');
        }
        return redirect()->route('articles.index', ['institution' => $institution]);
    });
    
    Route::resource('articles', ArticleController::class)->middleware('check.institution');
    Route::get('/chat', [App\Http\Controllers\ChatController::class, 'index'])->name('chat.index');
    Route::get('/messages', [App\Http\Controllers\ChatController::class, 'fetchMessages'])->name('chat.fetch');
    Route::post('/messages', [App\Http\Controllers\ChatController::class, 'sendMessage'])->name('chat.send');
});