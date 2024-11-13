<?php

namespace Yanah\LaravelEase;

use Illuminate\Support\ServiceProvider;
use Yanah\LaravelEase\Console\Commands\GenerateResource;

class ResourceGeneratorServiceProvider extends ServiceProvider
{
    public function boot()
    {
        \Log::info('test');
        if ($this->app->runningInConsole()) {
            $this->commands([
                GenerateResource::class,
            ]);
        }
    }
}
