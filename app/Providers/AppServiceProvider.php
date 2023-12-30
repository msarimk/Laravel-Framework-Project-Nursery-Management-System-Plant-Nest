<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Cart;
use App\Models\CompanyDetail;

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
        // Share the cart_count variable with the header layout
        View::composer('layouts.web', function ($view) {
            // Retrieve and pass the cart count logic here
            $company = CompanyDetail::get();
            foreach($company as $comp){
                $view->with('comp', $comp);
            }
            
            // dd($company);
            
            if(auth()->user()){
                $cart_count = Cart::where('user_id',auth()->user()->id)->count();
                $company = CompanyDetail::get();
                $view->with('cart_count', $cart_count);
            }
            else{
                $cart_count = 0;
                $view->with('cart_count', $cart_count);
            }
        });
    }
}
