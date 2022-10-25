FROM php:8.1.7-fpm-alpine

LABEL maintainer="Nazar Taran"

WORKDIR /var/www/html

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
COPY php.ini /usr/local/etc/php/
RUN docker-php-ext-install -j$(nproc) pdo_mysql


CMD php artisan key:generate && \
    php-fpm
