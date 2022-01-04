#!/usr/bin/env bash

docker-compose \
    -f cloud.yaml \
    -p cloud-minuman_tile_itsgitz_com \
    -v "$(pwd):/var/www/minuman-tile.itsgitz.com"
    -w /var/www/minuman-tile.itsgitz.com
    exec \
    web \
    php artisan db:seed
