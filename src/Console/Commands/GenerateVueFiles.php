<?php

namespace Yanah\LaravelEase\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateVueFiles extends Command
{
    protected $signature = 'ease:vue {name}';
    protected $description = 'Generate vue crud files';

    
    public function handle()
    {
        $name = $this->argument('name');
        $this->generateVueComponents($name);
    }

    protected function generateVueComponents(string $name): void
    {
        $actions = ['create', 'show', 'list', 'edit'];
        $pathBase = strtolower($name);

        foreach ($actions as $action) {
            $componentName = $name . ucfirst($action);
            $path = resource_path("js/modules/{$pathBase}/{$componentName}.vue");

            if (File::exists($path)) {
                $this->error("Vue component {$componentName} already exists at {$path}!");
                continue;
            }

            $stubPath = __DIR__ . "/stubs/vue_{$action}.stub";
            if (!File::exists($stubPath)) {
                $this->error("Stub file not found for {$action} at {$stubPath}!");
                continue;
            }

            $stub = File::get($stubPath);
            $content = str_replace('{{ componentName }}', $componentName, $stub);
            File::ensureDirectoryExists(resource_path("js/modules/{$pathBase}"));
            File::put($path, $content);

            $this->info("Vue component {$componentName} created at {$path}");
        }
    }
}