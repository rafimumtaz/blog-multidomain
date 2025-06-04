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
    public function boot(): void
    {
        if (app()->runningInConsole()) return;

        $host = request()->getHost();
        $subdomain = explode('.', $host)[0];

        $institution = Institution::where('domain', $host)->firstOrFail();

        if (!$institution) {
            abort(404, 'Institution not found');
        }

        // $institution->subdomain = $subdomain;

        View::share('institution', $institution);
        $GLOBALS['institution'] = $institution;
    }


}
