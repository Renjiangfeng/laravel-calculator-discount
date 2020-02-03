<?php

namespace Eric\LaravelCalculatorDiscount;

use Illuminate\Support\ServiceProvider;

class RenLaravelCalculatorServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/laravel-calculator-discount.php', 'laravel-calculator-discount'
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/laravel-calculator-discount.php' => config_path('laravel-calculator-discount.php'),
            __DIR__ . '/../database/migrations/' => database_path('/migrations'),
            __DIR__ . '/../model/Discount.php'     => app_path('/models/Discount.php'),
            __DIR__ . '/../model/DiscountAction.php'     => app_path('/models/DiscountAction.php'),
            __DIR__ . '/../model/DiscountRule.php'     => app_path('/models/DiscountRule.php'),
        ]);
        $this->loadRoutesFrom(__DIR__.'/routes.php');
    }
}
