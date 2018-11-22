#!/usr/bin/env bash

FRAMEWORK=$1
PATH="/var/www/html/vendor/bin"

if [ "$FRAMEWORK" == "phpunit" ]; then
    /usr/bin/docker exec apache_local bash -c "$PATH/phpunit tests/PhpUnit"
fi

if [ "$FRAMEWORK" == "mockery" ]; then
    /usr/bin/docker exec apache_local bash -c "$PATH/phpunit tests/Mockery"
fi

if [ "$FRAMEWORK" == "codeception" ]; then
    /usr/bin/docker exec apache_local bash -c "$PATH/codecept run"
fi
