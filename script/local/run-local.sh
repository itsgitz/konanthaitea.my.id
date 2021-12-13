#!/usr/bin/env bash

echo "[*] Run MariaDB ..."
./script/local/run-mariadb.sh

echo "[*] Run migrations ..."
sleep 1
echo "[*] Waiting for database connection ..."
sleep 10
php artisan migrate

echo "[*] Create storage link ..."
php artisan storage:link

echo "[*] Run Laravel web server ..."
php artisan serve
