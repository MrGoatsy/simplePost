<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     * @admin, @endadmin
     * @moderator, @endmoderator
     */
    public function boot() {
        Paginator::useBootstrap();

        Blade::if('admin', function () {
            if (Auth::user() && Auth::user()->rank >= 999) {
                return 1;
            }
            return 0;
        });

        Blade::if('moderator', function () {
            if (Auth::user() && Auth::user()->rank >= 500) {
                return 1;
            }
            return 0;
        });
    }
}
