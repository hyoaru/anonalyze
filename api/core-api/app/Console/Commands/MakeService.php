<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeService extends Command
{
    protected $signature = 'make:service {name}';
    protected $description = 'Create a new service class';

    public function handle()
    {
        $name = $this->argument('name');
        $path = app_path("Services/{$name}.php");

        if (File::exists($path)) {
            $this->error("Service {$name} already exists!");
            return;
        }

        $template = "<?php\n\nnamespace App\Services;\n\nclass {$name}\n{\n    // Define your methods here\n}\n";
        File::ensureDirectoryExists(app_path('Services'));
        File::put($path, $template);

        $this->info("Service {$name} created successfully.");
    }
}
