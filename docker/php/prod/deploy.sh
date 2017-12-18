#!/usr/bin/env bash
composer install

cp apps/config/config-prod.php apps/config/config.php

php-fpm
