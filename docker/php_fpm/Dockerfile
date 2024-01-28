FROM php:8.3-fpm

RUN mkdir -p /var/www/symfony

RUN apt-get update && apt-get install -y unzip zlib1g-dev libxml2-dev libmcrypt-dev libzip-dev default-mysql-client  libgd-dev

RUN docker-php-ext-install pdo pdo_mysql zip bcmath opcache sockets && docker-php-ext-enable opcache

RUN apt-get update && apt-get install -y \
        libssh-dev \
    && docker-php-ext-install \
        bcmath \
        sockets

RUN pecl install redis && docker-php-ext-enable redis

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN pecl install xdebug-3.3.1 && docker-php-ext-enable xdebug
RUN mkdir -p /var/log/xdebug
RUN touch /var/log/xdebug/xdebug.log
RUN chown www-data:www-data /var/log/xdebug/xdebug.log
RUN chmod 664 /var/log/xdebug/xdebug.log

USER www-data
