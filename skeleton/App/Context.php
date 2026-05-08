<?php

namespace App;

use Nyoze\Core\App;

class Context
{
    public function register(App $app): void
    {
        $app->load([
            // Register your entities here:
            // Entities\TasksEntity::class,
        ]);
    }
}
