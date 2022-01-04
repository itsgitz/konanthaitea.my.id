#!/usr/bin/env bash

docker-compose \
    -f cloud.yaml \
    -p cloud-minuman_tile_itsgitz_com \
    exec \
    -w /var/www/minuman-tile.itsgitz.com \
    web \
    php artisan db:seed
