<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;

Route::domain('{institution}.localhost')->group(function () {
    // Homepage untuk subdomain institusi
    Route::get('/', function ($institution) {
        return "Homepage untuk institusi: $institution";
    });

    // Resource controller untuk articles (otomatis butuh parameter institution)
    Route::resource('articles', ArticleController::class);
});
