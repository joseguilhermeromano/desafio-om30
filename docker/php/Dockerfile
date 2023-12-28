ARG PHP_VERSION=8.0.19-fpm

FROM php:${PHP_VERSION}

RUN apt-get update
RUN apt-get install -y --no-install-recommends \
    apt-utils

RUN apt-get install -y --no-install-recommends supervisor
COPY ./supervisord/supervisord.conf /etc/supervisor
COPY ./supervisord/conf /etc/supervisord.d/

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install unzip utility and libs needed by zip PHP extension 
RUN apt-get update && apt-get install -y \
    zlib1g-dev \
    libzip-dev \
    unzip \
    libpng-dev \
    libpq-dev \
    libxml2-dev

RUN docker-php-ext-install mysqli pdo pdo_mysql pdo_pgsql pgsql session xml bcmath opcache 

RUN docker-php-ext-install zip  iconv simplexml pcntl gd fileinfo

RUN cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini

ARG REDIS_LIB_VERSION=5.3.7

RUN pecl install redis-${REDIS_LIB_VERSION} \
    && docker-php-ext-enable redis 


EXPOSE 9000

ARG APP_DIR=/var/www

WORKDIR ${APP_DIR}
RUN chmod -R 755 ${APP_DIR}
RUN chown -R www-data:www-data ${APP_DIR}

RUN apt-get clean && rm -rf /var/lib/apt/lists/*
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/supervisord.conf"]