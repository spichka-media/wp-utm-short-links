FROM php:8.3-fpm

WORKDIR /app

RUN apt-get update \
    && apt-get install -y \
        zlib1g-dev \
        libzip-dev \
        libicu-dev \
        libpq-dev \
        libpng-dev \
        libjpeg-dev \
        g++ \
        zip \
        libpq5 \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

RUN pecl install xdebug && docker-php-ext-enable xdebug
COPY xdebug.ini /usr/local/etc/php/conf.d/

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
