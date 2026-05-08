<?php

require __DIR__ . '/vendor/autoload.php';

use App\Context;
use Nyoze\Core\Kernel;
use Nyoze\Data\PdoRepository;
use Nyoze\Support\Config;

$config = Config::fromEnv(__DIR__ . '/.env');

$kernel = Kernel::load(function (\Nyoze\Core\App $app) use ($config) {
    $dsn = $config->get('DB_DSN', 'mysql:host=127.0.0.1;dbname=myapp;charset=utf8mb4');
    $pdo = new PDO($dsn, $config->get('DB_USER'), $config->get('DB_PASS'));
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $app->useRepository(new PdoRepository($pdo));
    (new Context())->register($app);
});

$kernel->app()->run();
