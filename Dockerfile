FROM php:8.1-apache

RUN docker-php-ext-install pdo pdo_mysql

RUN apt-get update && \
    apt-get install -y zlib1g-dev libpng-dev libjpeg-dev

RUN docker-php-ext-configure gd --with-jpeg && \
    docker-php-ext-install gd

RUN chown -R www-data:www-data /var/www/html