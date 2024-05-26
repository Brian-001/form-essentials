<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Filesystem\Filesystem;

class EnumMakeCommand extends Command
{
    protected $signature = 'make:enum {name} {values?*}';

    protected $description = 'Create a new enum class';

    public function handle(Filesystem $files)
    {
        $enumName = $this->argument('name');
        $enumValues = $this->argument('values');

        $enumPath = app_path("Enums/{$enumName}.php");
        $enumsDir = dirname($enumPath);

        if (!$files->isDirectory($enumsDir)) {
            $files->makeDirectory($enumsDir, 0755, true);
        }

        if (file_exists($enumPath)) {
            $this->error("Enum {$enumName} already exists.");
            return;
        }

        $enumTemplate = <<<EOT
<?php

namespace App\Enums;

enum {$enumName}: string
{
EOT;

        if ($enumValues) {
            foreach ($enumValues as $value) {
                $enumTemplate .= "
    case " . Str::upper(Str::replace('-', '_', $value)) . " = '" . $value . "';";
            }
        }

        $enumTemplate .= "
}
";

        file_put_contents($enumPath, $enumTemplate);

        $this->info("Enum {$enumName} created successfully.");
    }
}
