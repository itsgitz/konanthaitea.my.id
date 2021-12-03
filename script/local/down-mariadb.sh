#!/usr/bin/env bash

docker-compose -f mariadb.yml down -v
docker system prune -f
