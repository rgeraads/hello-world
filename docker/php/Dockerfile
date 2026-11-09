FROM php:8.5-fpm

# Install Composer
# see https://medium.com/@othillo/adding-composer-to-php-docker-images-using-multi-stage-builds-2a10967ae6c1
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Install PHP package installer
COPY --from=ghcr.io/mlocati/php-extension-installer:2.12 /usr/bin/install-php-extensions /usr/local/bin/

# Main libs
RUN apt-get update && apt-get install --yes git zip

# PHP Extensions
RUN install-php-extensions pdo pdo_mysql mongodb

# Env vars
ENV COMPOSER_ALLOW_SUPERUSER 1

RUN mkdir -m 777 -p /var/tmp/opcache

COPY php.ini /usr/local/etc/php/php.ini
COPY opcache.ini /usr/local/etc/php/conf.d/opcache.ini

WORKDIR /app

COPY . /app
