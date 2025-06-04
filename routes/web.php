<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;

Route::pattern('institution', '[a-z0-9\-]+');
Route::pattern('article', '[0-9]+');

Route::domain('{institution}.localhost')->group(function () {
    Route::get('/', function ($institution) {
        return "Homepage untuk institusi: $institution";
    });

    Route::resource('articles', ArticleController::class);
});
