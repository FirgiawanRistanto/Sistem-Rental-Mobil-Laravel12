<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use App\Http\View\Composers\NotificationComposer;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Log;

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
        Paginator::useBootstrapFive();
        Carbon::setLocale('id');

        Log::info('AppServiceProvider - config(app.url): ' . config('app.url'));
        Log::info('AppServiceProvider - url()->current(): ' . url()->current());

        URL::forceRootUrl(config('app.url'));

        View::composer(['layouts.app', 'layouts.store'], NotificationComposer::class);
    }
}