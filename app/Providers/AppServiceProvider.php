<?php

namespace App\Providers;

use App\Invoice_detail;
use App\Observers\Invoice_detailObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Invoice_detail::observe(Invoice_detailObserver::class);
    }
}
