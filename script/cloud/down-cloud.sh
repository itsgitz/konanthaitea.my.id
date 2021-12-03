#!/usr/bin/env bash

echo "[*] Down the services on Cloud (Production) ..."

DOCKER_BUILDKIT=1 \
    docker-compose -f cloud.yaml \
    -p cloud-minuman_tile_itsgitz_com \
    down -v

docker system prune -f
