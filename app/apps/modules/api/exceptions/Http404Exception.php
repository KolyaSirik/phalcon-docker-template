<?php

namespace Api\Exceptions;

/**
 * Class Http404Exception
 *
 * Execption class for Not Found Error (404)
 *
 * @package App\Lib\Exceptions
 */
class Http404Exception extends AbstractHttpException
{
    protected $httpCode = 404;
    protected $httpMessage = 'Not Found';
}
