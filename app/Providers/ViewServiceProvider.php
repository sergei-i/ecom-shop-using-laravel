<?php

namespace App\Providers;

use App\Services\CurrencyConversion;
use App\ViewComposers\BestProductsComposer;
use App\ViewComposers\CategoriesComposer;
use App\ViewComposers\CurrenciesComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['layouts.master', 'categories'], CategoriesComposer::class);
        View::composer(['layouts.master'], CurrenciesComposer::class);
        View::composer(['layouts.master'], BestProductsComposer::class);

        View::composer('*', function (\Illuminate\View\View $view) {
            $currencySymbol = CurrencyConversion::getCurrencySymbol();
            $view->with('currencySymbol', $currencySymbol);
        });
    }
}
