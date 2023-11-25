<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\TrainingReportService;

class TrainingReportServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('App\Services\TrainingReportService', function($app) {
            return new TrainingReportService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
