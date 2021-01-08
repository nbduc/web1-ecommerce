<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
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
        view()->composer(
            [
                'pages.common.home',
                'pages.common.product',
                'pages.common.search',
                'pages.user.cart',
                'pages.user.favourites',
                'pages.user.profile',
                'pages.user.order',
                'pages.user.success-order',
                'admin.orders.index',
                'admin.orders.show',
                'admin.product.create',
                'admin.product.index',
                'admin.user.create',
                'admin.user.edit',
                'admin.user.index',
                'admin.user.show',
            ],
            'App\Http\ViewComposers\UserComposer'
        );
    }
}
