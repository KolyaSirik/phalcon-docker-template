#!/usr/bin/env bash
composer install

cp apps/config/config-local.php apps/config/config.php

php-fpm
