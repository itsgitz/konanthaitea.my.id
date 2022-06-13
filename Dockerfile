FROM php:7.4-fpm

WORKDIR /var/www/minuman-tile.itsgitz.com
COPY . /var/www/minuman-tile.itsgitz.com

# Install system dependencies
RUN apt-get update; \
    apt-get install -y \
    git \
    curl \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip; \

# Clear cache
    apt-get clean; \
    rm -rf /var/lib/apt/lists/*; \

# Install PHP extensions
    docker-php-ext-configure zip; \
    docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip opcache; \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer;
