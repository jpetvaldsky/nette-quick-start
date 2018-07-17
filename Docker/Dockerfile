FROM php:7-apache

COPY ./000-default.conf /etc/apache2/sites-enabled/000-default.conf

RUN apt-get update -y && apt-get install -y libpng-dev curl libcurl4-openssl-dev libjpeg62-turbo-dev

RUN docker-php-ext-install pdo pdo_mysql curl mysqli

RUN docker-php-ext-configure gd --with-jpeg-dir=/usr/include/ --with-png-dir=/usr/lib/ --with-gd
RUN docker-php-ext-install gd

RUN apt-get update && apt-get install -y \
        libmagickwand-dev --no-install-recommends

RUN pecl install imagick && docker-php-ext-enable imagick

RUN a2enmod rewrite
RUN service apache2 restart

ENV ALLOW_OVERRIDE true