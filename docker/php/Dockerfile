FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git unzip curl libicu-dev libzip-dev libpq-dev libonig-dev libxml2-dev \
    && docker-php-ext-install intl pdo pdo_mysql opcache zip

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
