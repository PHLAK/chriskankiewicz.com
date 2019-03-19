FROM composer:1.8 as build
COPY . /app
COPY ./.docker/auth.json /tmp/auth.json
RUN composer install --ignore-platform-reqs --no-dev --no-interaction --working-dir /app

FROM php:7.2-apache
MAINTAINER Chris Kankiewicz <ckankiewicz@freedomdebtrelief.com>

ARG INSTALL_XDEBUG="false"

RUN a2enmod rewrite

COPY --from=build /app /var/www/html
COPY ./.docker/php/config/php.prd.ini /usr/local/etc/php/php.ini
COPY ./.docker/apache2/config/000-default.prd.conf /etc/apache2/sites-available/000-default.conf

RUN apt-get update && apt-get install -y libxml2-dev zlib1g-dev \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install bcmath pdo_mysql \
    && pecl install redis && docker-php-ext-enable redis

RUN [ "${INSTALL_XDEBUG}" = "true" ] && pecl install xdebug && docker-php-ext-enable xdebug
