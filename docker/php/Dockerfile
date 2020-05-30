# see https://medium.com/@othillo/adding-composer-to-php-docker-images-using-multi-stage-builds-2a10967ae6c1

# use the official PHP image as base image
FROM php:7.4.6

# copy the Composer PHAR from the Composer image into the PHP image
COPY --from=composer:1.10.6 /usr/bin/composer /usr/bin/composer

# show that both Composer and PHP run as expected
RUN composer --version && php -v

ENV COMPOSER_ALLOW_SUPERUSER 1

COPY php.ini /usr/local/etc/php/php.ini

WORKDIR /app

COPY . /app
