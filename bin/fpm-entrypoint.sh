#!/bin/bash

set -e

composer install --prefer-dist --no-scripts --optimize-autoloader

console assets:install --no-interaction

docker-php-entrypoint php-fpm --allow-to-run-as-root

exec "$@"
