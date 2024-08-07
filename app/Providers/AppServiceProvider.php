<?php

namespace App\Providers;

use App\User;
use App\Invoice_detail;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Observers\Invoice_detailObserver;

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
        Schema::defaultStringLength(191);
        Invoice_detail::observe(Invoice_detailObserver::class);

        Gate::define('admin', function(User $user){
            return $user->is_admin;
        });

        Gate::define('keuangan', function(User $user){
            return $user->is_keuangan;
        });

        Gate::define('direktur', function(User $user){
            return $user->is_direktur;
        });
    }
}
