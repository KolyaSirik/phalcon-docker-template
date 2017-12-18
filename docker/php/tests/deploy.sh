#!/usr/bin/env bash
composer install

cp apps/config/config-tests.php apps/config/config.php

echo "\nYour application is ready.\n"
php-fpm
