<?php

namespace Nyoze\Installer;

class NewCommand
{
    public function __construct(private Output $output) {}

    public function run(string $name): int
    {
        $targetDir = getcwd() . '/' . $name;

        // 1. Validate target doesn't exist
        if (is_dir($targetDir) || file_exists($targetDir)) {
            $this->output->error("Directory '{$name}' already exists.");
            return 1;
        }

        // 2. Copy skeleton
        $copier = new SkeletonCopier();
        $copier->copy($this->skeletonPath(), $targetDir);

        // 3. Generate .env
        $env = new EnvGenerator();
        $env->generate($targetDir, $name);

        // 4. Set permissions on local CLI
        chmod($targetDir . '/nyoze', 0755);

        // 5. Run composer install
        $composer = new ComposerRunner($this->output);
        $result = $composer->install($targetDir);

        if ($result !== 0) {
            $this->output->error('Composer install failed. Check the output above.');
            return 1;
        }

        // 6. Success message
        $this->output->success($name);
        return 0;
    }

    private function skeletonPath(): string
    {
        return dirname(__DIR__) . '/skeleton';
    }
}
