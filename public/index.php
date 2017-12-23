<?php
require __DIR__ . '/../vendor/autoload.php';

$app = new Microframework\App();

require __DIR__ . '/../src/router.php';

$app->setRenderer(new Microframework\Renderer\PHPRenderer());
$app->run();