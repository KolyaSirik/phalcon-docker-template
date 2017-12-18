#!/usr/bin/env bash
composer install

cp apps/config/config-dev.php apps/config/config.php

php-fpm
