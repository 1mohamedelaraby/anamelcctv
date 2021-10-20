<?php

namespace App\Providers;

use App\Setting;
use App\PaymentGetway\CreditClass;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;
use App\PaymentGetway\BankTransfereClass;
use App\PaymentGetway\PaymentGetwayInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(PaymentGetwayInterface::class, function () {
            if (request()->has('payment_type')) {
                switch (request()->payment_type) {
                    case '1':
                        return new BankTransfereClass();
                        break;
                    case '2':
                        return new CreditClass();
                        break;
                    default:
                        return new BankTransfereClass();
                        break;
                }
            }
            return new BankTransfereClass();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (!\App::runningInConsole()) {
            $site = Cache::remember('settings', 60 * 60 * 60 * 24, function () {
                return Setting::first();
            });

            View::share('site', $site);
        }
    }
}
