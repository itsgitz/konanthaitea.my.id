FROM php:7.4-fpm

WORKDIR /var/www/minuman-tile.itsgitz.com
COPY . /var/www/minuman-tile.itsgitz.com

RUN apt-get install -y \
        libzip-dev \
        zip; \
        docker-php-ext-install zip; \
        docker-php-ext-install mysql; \
        docker-php-ext-install mysqli; \
        docker-php-ext-install gd; \
        docker-php-ext-install pdo; \
        docker-php-ext-install pdo_mysql; \
        chown -R www-data:www-data storage; \
        chmod 777 -Rvf storage;
