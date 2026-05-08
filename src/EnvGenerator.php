<?php

namespace Nyoze\Installer;

class EnvGenerator
{
    public function generate(string $projectDir, string $projectName): void
    {
        $appName = $this->deriveAppName($projectName);

        $content = implode("\n", [
            "APP_NAME={$appName}",
            "DB_DSN=mysql:host=127.0.0.1;dbname={$projectName};charset=utf8mb4",
            "DB_USER=root",
            "DB_PASS=secret",
            "",
        ]);

        file_put_contents($projectDir . '/.env', $content);
    }

    public function deriveAppName(string $projectName): string
    {
        // Convert kebab-case/snake_case to Title Case
        $name = str_replace(['-', '_'], ' ', $projectName);
        return ucwords($name);
    }
}
