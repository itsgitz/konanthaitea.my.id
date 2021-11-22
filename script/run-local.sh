#!/usr/bin/env bash

echo "[*] Run MariaDB ..."
./script/run-mariadb.sh

echo "[*] Run migrations ..."
sleep 1
echo "[*] Waiting for database connection ..."
sleep 10
php artisan migrate

echo "[*] Run Laravel web server ..."
php artisan serve
