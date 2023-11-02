<?php

namespace App\Providers;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Blade;
use Illuminate\Database\Eloquent\Model;
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
        Carbon::setlocale(config('app.locale'));

        DB::enableQueryLog();

        Model::preventLazyLoading();

        Paginator::useBootstrapFive();

        Blade::if('invalid', function (string $value) {
            return request('invalid') == $value;
        });

        Blade::if('modal_is', function (string $value) {
            return request('_modal') == $value;
        });
    }
}
