<?php

namespace Twentysix\Booker;

use Illuminate\Support\ServiceProvider;

class BookerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Loading

        $this->loadViewsFrom(__DIR__.'/Views', 'booker');

        // Publishing

        $this->publishes([
            __DIR__.'/Database/Migrations/' => database_path('migrations')
        ], 'migrations');

        $this->publishes([
            __DIR__.'/Views/backend/booking' => base_path('resources/views/backend/booker'),
        ], 'views');

        $this->publishes([
            __DIR__.'/assets/js' => public_path('js/bookings'),
        ], 'public');

        $this->publishes([
            __DIR__.'/Config/booker.php' => config_path('booker.php'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        include __DIR__.'/routes.php';

        $this->app->make('Twentysix\Booker\Controllers\Admin\Bookings\BookingController');
    }
}
