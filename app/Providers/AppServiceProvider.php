<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Institution;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void{
        if (app()->runningInConsole()) return;

        $host = request()->getHost(); 
        $subdomain = explode('.', $host)[0]; // ambil 'univ-a'

        $institution = Institution::where('domain', $host)->firstOrFail();

        $institution->subdomain = $subdomain;

        View::share('institution', $institution);
        $GLOBALS['institution'] = $institution;
    }

}
