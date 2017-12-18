<?php

$config = include __DIR__ . "/config-main.php";

//include __DIR__ . "/loader.php";

include __DIR__ . "/services.php";

return new \Phalcon\Mvc\Application($di);