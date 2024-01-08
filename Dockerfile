##############################
##        PHP  8.3          ##
##############################

ARG PHP_VERSION=8.3-fpm-alpine

FROM php:${PHP_VERSION}

# Certificados SSL
RUN apk --update add ca-certificates && update-ca-certificates

# Bibliotecas do PHP
RUN apk --update add  zlib-dev \
    libzip-dev \
    libpng-dev \
    libpq \
    vim \
    fcgi \
    libxml2-dev \
    postgresql-client \
    openssl \
    openssl-dev \
    iputils \
    libxslt-dev \
    libgcrypt-dev \
    libmcrypt-dev \
    gmp-dev \
    libpq-dev \
    libcurl \
    curl-dev \
    curl \
    acl \
    file \
    gettext \
    git \
    gnu-libiconv \
    gcompat \
    bind-tools\
    bash build-base gcc wget git autoconf libmcrypt-dev libzip-dev zip linux-headers

RUN docker-php-ext-install pdo_pgsql pgsql session xml bcmath opcache curl

RUN docker-php-ext-install zip simplexml pcntl gd fileinfo

WORKDIR /var/www

COPY --chown=www-data:www-data --chmod=775 ./app/backend .

RUN chmod -R 777 /var/www/storage

EXPOSE 9004

#################################
##         LOGS PHP            ##
#################################

RUN mkdir -p /var/log/php
RUN chown www-data:adm /var/log/php
RUN chmod 755 /var/log/php

#################################
##           COMPOSER          ##
#################################

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

#################################
##          XDEBUG             ##
#################################

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

EXPOSE 9003

#################################
##         NGINX 1.19.6        ##
#################################

RUN apk --update add nginx

#################################
##      BIBLIOTECA REDIS       ##
#################################

ARG REDIS_LIB_VERSION=5.3.7

RUN pecl install redis-${REDIS_LIB_VERSION} \
    && docker-php-ext-enable redis

#################################
##         SUPERVISOR          ##
#################################

### apt-utils é um extensão de recursos do gerenciador de pacotes APT
RUN apk --update add supervisor

COPY ./docker/supervisor/supervisord.conf /etc/supervisord.conf

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]