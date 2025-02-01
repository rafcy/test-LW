<?php

use App\Services\MailchimpService;
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
        $this->app->singleton(MailchimpService::class, function ($app) {
            return new MailchimpService();
        });

    }
}
