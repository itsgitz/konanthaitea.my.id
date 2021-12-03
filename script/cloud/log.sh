#!/usr/bin/env bash

docker-compose -f cloud.yaml -p cloud-minuman_tile_itsgitz_com logs -f --tail 20
