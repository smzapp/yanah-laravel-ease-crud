<?php

namespace Yanah\LaravelEase;

use Illuminate\Support\ServiceProvider;
use Yanah\LaravelEase\Console\Commands\GenerateResource;

class EaseServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                GenerateResource::class,
            ]);
        }
    }
}
