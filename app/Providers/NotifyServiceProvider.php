<?php

namespace App\Providers;

use App\Common\Http;
use Illuminate\Support\ServiceProvider;

class NotifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Http::class, function() {
            return new Http();
        });
    }
}
