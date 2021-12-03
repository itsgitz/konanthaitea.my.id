#!/usr/bin/env bash

docker-compose \
    -f cloud.yaml \
    -p cloud-minuman_tile_itsgitz_com \
    exec \
    web \
    php artisan optimize:clear

docker-compose \
    -f cloud.yaml \
    -p cloud-minuman_tile_itsgitz_com \
    exec \
    web \
    php artisan config:cache

docker-compose \
    -f cloud.yaml \
    -p cloud-minuman_tile_itsgitz_com \
    exec \
    web \
    php artisan route:cache


docker-compose \
    -f cloud.yaml \
    -p cloud-minuman_tile_itsgitz_com \
    exec \
    web \
    php artisan view:cache
