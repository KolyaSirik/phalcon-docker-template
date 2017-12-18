<?php

namespace Api\Controllers\v1;

/**
 * Class IndexController
 *
 * @package Api\Controllers\v1
 */
class DefaultController extends BaseController
{
    public function index()
    {
        return ['Hello world!'];
    }
}
