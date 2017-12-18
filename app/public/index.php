<?php

use Api\Exceptions\AbstractHttpException;

try {
    // Loading Configs
    $config = require(__DIR__ . '/../apps/config/config-main.php');
    $configEnv = require(__DIR__ . '/../apps/config/config.php');
    $config->merge($configEnv);

    // Autoloading classes
    require __DIR__ . '/../apps/config/loader.php';

    require __DIR__ . '/../apps/config/DI.php';

    // Initializing DI container
    /** @var \Phalcon\DI\FactoryDefault $di */
    $di = require __DIR__ . '/../apps/config/di.php';

    // Initializing application
    $app = new \Phalcon\Mvc\Micro();
    // Setting DI container
    $app->setDI($di);

    // Setting up routing
    require __DIR__ . '/../apps/config/routes.php';

    // Making the correct answer after executing
    $app->after(
        function () use ($app) {
            // Getting the return value of method
            $return = $app->getReturnedValue();

            if (is_array($return)) {
                // Transforming arrays to JSON
                $app->response->setContent(json_encode($return));
            } elseif (!strlen($return)) {
                // Successful response without any content
                $app->response->setStatusCode('204', 'No Content');
            } else {
                // Unexpected response
                throw new Exception('Bad Response');
            }

            // Sending response to the client
            $app->response->send();
        }
    );

    // not found URLs
    $app->notFound(
        function () use ($app) {
            $exception =
                new \Api\Exceptions\Http404Exception(
                    'URI not found or error in request.',
                    \Api\Controllers\v1\BaseController::ERROR_NOT_FOUND,
                    new \Exception('URI not found: ' . $app->request->getMethod() . ' ' . $app->request->getURI())
                );
            throw $exception;
        }
    );

    // Processing request
    $app->handle();
} catch (AbstractHttpException $e) {
    $response = $app->response;
    $response->setStatusCode($e->getCode(), $e->getMessage());
    $response->setJsonContent($e->getAppError());
    $response->send();
} catch (\Phalcon\Http\Request\Exception $e) {
    $app->response->setStatusCode(400, 'Bad request')
        ->setJsonContent([
            AbstractHttpException::KEY_CODE    => 400,
            AbstractHttpException::KEY_MESSAGE => 'Bad request'
        ])
        ->send();
} catch (\Exception $e) {
    // Standard error format
    $result = [
        AbstractHttpException::KEY_CODE    => 500,
        AbstractHttpException::KEY_MESSAGE => 'Some error occurred on the server.'
    ];

    // Sending error response
    $app->response->setStatusCode(500, 'Internal Server Error')
        ->setJsonContent($result)
        ->send();
}
