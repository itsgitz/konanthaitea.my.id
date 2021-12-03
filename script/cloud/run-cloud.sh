#!/usr/bin/env bash

echo "[*] Run the services on Cloud (Production) ..."

DOCKER_BUILDKIT=1 \
    docker-compose -f cloud.yaml \
    -p cloud-minuman_tile_itsgitz_com \
    up --build -d

echo "[*] Waiting MariaDB ..."
sleep 10

echo "[*] Run DB Migration ..."
./script/cloud/migrations.sh

echo "[*] Run DB Seeding ..."
./script/cloud/seed.sh

echo "[*] Run Storage Linking ..."
./script/cloud/storage.sh
