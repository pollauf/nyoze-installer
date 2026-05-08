<?php

namespace Nyoze\Installer;

class Output
{
    public function info(string $message): void
    {
        echo "\033[34m{$message}\033[0m" . PHP_EOL;
    }

    public function success(string $projectName): void
    {
        echo PHP_EOL;
        echo "\033[32m✓ Project '{$projectName}' created successfully!\033[0m" . PHP_EOL;
        echo PHP_EOL;
        echo "  Next steps:" . PHP_EOL;
        echo "    cd {$projectName}" . PHP_EOL;
        echo "    nyoze serve" . PHP_EOL;
        echo PHP_EOL;
    }

    public function error(string $message): void
    {
        echo "\033[31m✗ {$message}\033[0m" . PHP_EOL;
    }

    public function line(string $message): void
    {
        echo $message . PHP_EOL;
    }

    public function help(): void
    {
        echo "Nyoze Installer" . PHP_EOL;
        echo PHP_EOL;
        echo "Usage:" . PHP_EOL;
        echo "  nyoze new <project-name>    Create a new Nyoze project" . PHP_EOL;
        echo PHP_EOL;
        echo "Options:" . PHP_EOL;
        echo "  --help, -h                  Show this help message" . PHP_EOL;
        echo PHP_EOL;
    }
}
