<?php

return new \Phalcon\Config(
    [
        'database' => [
            'adapter' => 'Mysql',
            'port' => 3306,
        ],

        'application' => [
	        'controllersDir' => "app/controllers/",
	        'modelsDir'      => "app/models/",
	        'baseUri'        => "/",
        ],
    ]
);
