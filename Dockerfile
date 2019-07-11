# Install PHP dependencies
FROM composer:1.8 AS php-dependencies
ARG COMPOSER_AUTH={}
COPY . /app
RUN composer install --ignore-platform-reqs --no-dev --no-interaction --working-dir /app

# Install and compile JavaScript assets
FROM node:12.4 AS js-dependencies
ARG FONT_AWESOME_TOKEN
COPY --from=php-dependencies /app /app
RUN npm config set "@fortawesome:registry" https://npm.fontawesome.com/
RUN npm config set "//npm.fontawesome.com/:_authToken" ${FONT_AWESOME_TOKEN}
RUN cd /app && npm install && npm run production

# Build application image
FROM php:7.3-apache
LABEL maintainer="Chris Kankiewicz <ckankiewicz@freedomdebtrelief.com>"

ARG INSTALL_XDEBUG="false"

RUN a2enmod rewrite

COPY --from=js-dependencies /app /var/www/html
COPY ./.docker/php/config/php.prd.ini /usr/local/etc/php/php.ini
COPY ./.docker/apache2/config/000-default.prd.conf /etc/apache2/sites-available/000-default.conf

RUN apt-get update && apt-get install -y libxml2-dev zlib1g-dev \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install bcmath pdo_mysql \
    && pecl install redis && docker-php-ext-enable redis

RUN if [ "${INSTALL_XDEBUG}" = "true" ]; then pecl install xdebug && docker-php-ext-enable xdebug; fi
