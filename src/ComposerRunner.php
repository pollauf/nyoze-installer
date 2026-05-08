<?php

namespace Nyoze\Installer;

class ComposerRunner
{
    public function __construct(private Output $output) {}

    public function install(string $directory): int
    {
        $command = 'composer install --no-interaction --prefer-dist 2>&1';

        $this->output->info('Installing dependencies...');

        $descriptors = [
            0 => ['pipe', 'r'],
            1 => ['pipe', 'w'],
            2 => ['pipe', 'w'],
        ];

        $process = proc_open($command, $descriptors, $pipes, $directory);

        if (!is_resource($process)) {
            $this->output->error('Failed to start composer process.');
            return 1;
        }

        fclose($pipes[0]);

        $stdout = stream_get_contents($pipes[1]);
        fclose($pipes[1]);

        $stderr = stream_get_contents($pipes[2]);
        fclose($pipes[2]);

        $exitCode = proc_close($process);

        if ($exitCode !== 0) {
            $this->output->line($stdout);
            $this->output->error($stderr);
        }

        return $exitCode;
    }
}
