#!/usr/bin/env bash

echo 'Building Docker environment...'
docker-compose build

echo 'Starting Docker containers ...'
docker-compose up -d
