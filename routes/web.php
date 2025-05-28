<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;

// Tambahkan ini untuk memberi tahu Laravel bahwa "institution" adalah parameter yang valid
Route::pattern('institution', '[a-z0-9\-]+');

Route::domain('{institution}.localhost')->group(function () {
    // Homepage untuk subdomain institusi
    Route::get('/', function ($institution) {
        return "Homepage untuk institusi: $institution";
    });

    // Resource controller untuk articles (otomatis butuh parameter institution)
    Route::resource('articles', ArticleController::class);
});
