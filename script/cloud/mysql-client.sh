#!/usr/bin/env bash

docker-compose \
    -f cloud.yaml \
    -p cloud-minuman_tile_itsgitz_com \
    exec \
    db \
    mysql -u root -p
