<?php

namespace Yanah\LaravelEase\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateResource extends Command
{
    protected $signature = 'ease:resource {name} {--only=}';
    protected $description = 'Generate a controller, model, and Vue component for a resource';

    public function handle()
    {
        $name = $this->argument('name');
        $only = $this->option('only') ? explode(',', $this->option('only')) : [];

        if (empty($only) || in_array('controller', $only)) {
            $this->generateController($name);
        }
        if (empty($only) || in_array('model', $only)) {
            $this->generateModel($name);
        }
        if (empty($only) || in_array('vue', $only)) {
            $this->call('ease:vue', ['name' => $name]);
        }

        $this->info("Resources for {$name} generated successfully!");
    }

    protected function generateController($name)
    {
        $path = app_path("Http/Controllers/{$name}Controller.php");
        if (File::exists($path)) {
            $this->error("Controller already exists at {$path}!");
            return;
        }

        $stub = File::get(__DIR__.'/stubs/controller.stub');
        $content = str_replace('{{ className }}', "{$name}Controller", $stub);
        File::put($path, $content);
        $this->info("Controller created at {$path}");
    }

    protected function generateModel($name)
    {
        $path = app_path("Models/{$name}.php");
        if (File::exists($path)) {
            $this->error("Model already exists at {$path}!");
            return;
        }

        $stub = File::get(__DIR__.'/stubs/model.stub');
        $content = str_replace('{{ className }}', $name, $stub);
        File::put($path, $content);
        $this->info("Model created at {$path}");
    }
}
