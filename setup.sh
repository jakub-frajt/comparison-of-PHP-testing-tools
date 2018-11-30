#!/usr/bin/env bash

echo 'Installing dependecies via Composer ...'
docker run --rm -it -v $PWD:/app -u $(id -u):$(id -g) composer install

echo 'Building && starting Docker containers ...'
docker-compose up -d

chmod -R 777 var/
