#!/usr/bin/env bash

echo 'Installing dependecies via Composer ...'
docker run --rm -it -v $PWD:/app -u $(id -u):$(id -g) composer install;

echo 'Building Docker environment...'
docker-compose build

echo 'Starting Docker containers ...'
docker-compose up -d
