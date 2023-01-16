<?php

require_once __DIR__.'/vendor/autoload.php';

use app\controllers\AuthController;
use app\controllers\SiteController;
use app\core\Application;
//use app\core\Router;

if(!isset($argv[1])){
    echo "Please enter \"up\" or \"down\" after migration.php!".PHP_EOL;
    exit;
}elseif ($argv[1]!=="up" && $argv[1]!=="down"){
    echo "Please enter \"up\" or \"down\" after migration.php!".PHP_EOL;
    exit;
}


$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$config = [
    'db'=> [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ]
];

$app = new Application(__DIR__, $config);

if($argv[1]==="up"){
    $app->db->applyMigrations();
}elseif ($argv[1]==="down"){
    $app->db->applyDownMigrations();
//    echo '<pre>';
//    var_dump(Application::$app->session->destroySession());
//    echo '</pre>';
//    exit;
//
//    echo "Session Destroyed".PHP_EOL;
//}

