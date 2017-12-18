<?php

/**
 * Class DI
 *
 * @method static \Phalcon\Session\Adapter\Files session()
› */
class DI
{
    public static function __callStatic($name, $arguments)
    {
        return Phalcon\Di::getDefault()->get($name);
    }
}
