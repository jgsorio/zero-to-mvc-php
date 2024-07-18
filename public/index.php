<?php

use App\Core\AppExtract;

session_start();

require_once __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../app/Views/index.php';

$appExtract = new AppExtract();
$appExtract->controller()->method()->params();
print_r($appExtract->data);