# see https://medium.com/@othillo/adding-composer-to-php-docker-images-using-multi-stage-builds-2a10967ae6c1

# use the official PHP image as base image
FROM php:8.3-fpm

RUN apt-get update && apt-get install --yes git zip

RUN docker-php-ext-install pdo pdo_mysql

# copy the Composer PHAR from the Composer image into the PHP image
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# show that both Composer and PHP run as expected
RUN composer --version && php -v

ENV COMPOSER_ALLOW_SUPERUSER 1

COPY php.ini /usr/local/etc/php/php.ini
COPY opcache.ini /usr/local/etc/php/conf.d/opcache.ini

WORKDIR /app

COPY . /app
