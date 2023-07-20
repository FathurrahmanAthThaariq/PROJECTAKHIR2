<?php

namespace App\Providers;

use App\Models\Cart;
use Illuminate\Support\Facades\View;
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
        View::composer('layouts.frontend.master', function ($view) {
            if (auth()->check()) {
                $carts = Cart::with('product')->where('user_id', auth()->id())->get();
                $view->with('carts', $carts);
            } else {
                $view->with('carts', []);
            }
        });
    }
}
