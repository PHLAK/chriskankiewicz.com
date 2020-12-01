FROM php:7.4-apache
LABEL maintainer="Chris Kankiewicz <Chris@ChrisKankiewicz.com>"

COPY --from=composer:2.0 /usr/bin/composer /usr/bin/composer
COPY --from=node:15.0 /usr/local/bin/node /usr/local/bin/node
COPY --from=node:15.0 /usr/local/bin/npm /usr/local/bin/npm

ENV COMPOSER_ALLOW_SUPERUSER=1
ENV COMPOSER_HOME="/tmp"
ENV PATH="vendor/bin:${PATH}"

COPY ./.docker/php/config/php.ini /usr/local/etc/php/php.ini
COPY ./.docker/apache2/config/000-default.conf /etc/apache2/sites-available/000-default.conf

RUN a2enmod rewrite

RUN apt-get update && apt-get install -y libxml2-dev zlib1g-dev \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install bcmath opcache pdo_mysql \
    && pecl install redis xdebug && docker-php-ext-enable redis xdebug

