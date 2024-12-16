<?php

namespace Shopia\Nowpayments;

use App\Models\PaymentSetting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Log;

class NowpaymentsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/nowpayments.php', 'nowpayments');

        $this->app->singleton('nowpayments', function ($app) {
            $settings = PaymentSetting::first();

            if ($settings) {
                $apiKey = $settings->sandbox_mode ? $settings->sandbox_api_key : $settings->live_api_key;
                
                Log::info('Nowpayments settings', [
                    'config' => [
                        'sandbox_mode' => $settings->sandbox_mode,
                        'currency' => $settings->default_currency,
                    ]
                ]);

                return new Nowpayments([
                    'api_key' => $apiKey,
                    'sandbox_mode' => $settings->sandbox_mode,
                    'currency' => $settings->default_currency
                ]);
            }

            // Fallback to config values if no settings in database
            return new Nowpayments([
                'api_key' => config('nowpayments.api_key'),
                'sandbox_mode' => config('nowpayments.sandbox_mode', false),
                'currency' => config('nowpayments.currency', 'USD')
            ]);
        });

        $this->app->alias('nowpayments', Nowpayments::class);
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/nowpayments.php' => config_path('nowpayments.php'),
        ], 'config');
    }
}
