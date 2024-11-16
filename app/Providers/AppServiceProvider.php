<?php

namespace App\Providers;

use App\View\Composers\AdvertisementComposer;
use App\View\Composers\CategoryComposer;
use App\View\Composers\PostComposer;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        View::composer('clients.layouts.header',  CategoryComposer::class);
        View::composer('clients.layouts.sidebar', CategoryComposer::class);

        View::composer('clients.layouts.sidebar', AdvertisementComposer::class);
        View::composer('clients.home',            AdvertisementComposer::class);
        View::composer('clients.category',        AdvertisementComposer::class);

        View::composer('clients.layouts.banner',  PostComposer::class);
        View::composer('clients.home',            PostComposer::class);
    }
}
