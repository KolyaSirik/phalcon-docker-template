<?php
/**
 * Services are globally registered in this file
 */

use Phalcon\Mvc\Router;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\DI\FactoryDefault;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;

/**
 * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
 */
$di = new FactoryDefault();

/**
 * Read configuration
 */
$config = include __DIR__ . "/config-main.php";

/**
 * Registering a router
 */
$di['router'] = function () {

    $router = new Router();

    $router->setDefaultModule("api");
    $router->setDefaultNamespace("Api\Controllers\\v1");

    $router->setUriSource(\Phalcon\Mvc\Router::URI_SOURCE_SERVER_REQUEST_URI);

    $router->removeExtraSlashes(true);

    return $router;
};

/**
 * The URL component is used to generate all kind of urls in the application
 */
$di['url'] = function () {
    $url = new UrlResolver();
    $url->setBaseUri('/');

    return $url;
};

/**
 * Database connection is created based in the parameters defined in the configuration file
 */
//$di['db'] = function () use ($config) {
//    return new DbAdapter(
//        [
//            "host" => $config->database->host,
//            "username" => $config->database->username,
//            "password" => $config->database->password,
//            "dbname" => $config->database->dbname
//        ]
//    );
//};
