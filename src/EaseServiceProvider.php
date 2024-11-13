<?php

namespace Yanah\LaravelEase;

use Illuminate\Support\ServiceProvider;
use Yanah\LaravelEase\Console\Commands\GenerateResource;
use Yanah\LaravelEase\Console\Commands\GenerateVueFiles;

class EaseServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                // Display config ease dynamically 

                // ease:install -> This should generate config/ease.php

                GenerateResource::class,
                GenerateVueFiles::class,
            ]);
        }
    }
}
