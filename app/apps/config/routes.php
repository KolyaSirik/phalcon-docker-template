<?php

use Phalcon\Mvc\Micro\Collection;

$default = new Collection;
$default->setHandler('\Api\Controllers\v1\DefaultController', true);
$default->get('/', 'index');
$app->mount($default);

$usersCollection = new \Phalcon\Mvc\Micro\Collection();
$usersCollection->setHandler('\Api\Controllers\v1\UsersController', true);
$usersCollection->setPrefix('/user');
$usersCollection->post('/add', 'addAction');
$usersCollection->get('/list', 'getUserListAction');
$usersCollection->put('/{userId:[1-9][0-9]*}', 'updateUserAction');
$usersCollection->delete('/{userId:[1-9][0-9]*}', 'deleteUserAction');
$app->mount($usersCollection);
