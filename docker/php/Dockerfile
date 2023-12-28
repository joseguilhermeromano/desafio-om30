ARG PHP_VERSION=8.0.24-fpm

FROM php:${PHP_VERSION}

RUN apt-get update
RUN apt-get install -y --no-install-recommends \
    apt-utils

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

# Install unzip utility and libs needed by zip PHP extension 
RUN apt-get update && apt-get install -y \
    zlib1g-dev \
    libzip-dev \
    unzip \
    libpng-dev \
    libpq-dev \
    vim \
    libfcgi-bin \
    telnet \
    libxml2-dev

RUN docker-php-ext-install mysqli pdo pdo_mysql pdo_pgsql pgsql session xml bcmath opcache 

RUN docker-php-ext-install zip  iconv simplexml pcntl gd fileinfo

RUN cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini

ARG REDIS_LIB_VERSION=5.3.7

RUN pecl install redis-${REDIS_LIB_VERSION} \
    && docker-php-ext-enable redis 

COPY ./php-fpm.d /usr/local/etc/php-fpm.d

ENV PHP_FPM_PORT 9004

EXPOSE ${PHP_FPM_PORT}

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www

CMD bash -c "sleep 10 && chown -R www-data:www-data /var/www && chmod -R 755 /var/www && php-fpm"