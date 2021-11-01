#!/usr/bin/env bash

username=$1

docker exec -it minuman-tile.itsgitz.com-db mysql -u $username -p minuman_tile
