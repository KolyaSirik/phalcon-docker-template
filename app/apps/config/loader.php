<?php

$loader = new \Phalcon\Loader();
$loader->registerNamespaces(
    [
        'Api\Controllers\v1' => realpath(__DIR__ . '/../modules/api/controllers/v1'),
        'Api\Exceptions' => realpath(__DIR__ . '/../modules/api/exceptions'),
        'Api\Services' => realpath(__DIR__ . '/../modules/api/services'),
        'Models' => realpath(__DIR__ . '/../models'),
    ]
);

$loader->register();
