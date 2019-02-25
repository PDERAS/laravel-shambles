<?php

namespace PDERAS\Shambles;

use Illuminate\Support\ServiceProvider;

class ShamblesServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/config/shambles.php', 'shambles');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/shambles.php' => config_path('shambles.php'),
        ]);
    }
}

?>
