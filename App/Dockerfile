FROM php:8.0-fpm-alpine3.16

RUN apk add --no-cache --update sudo certbot libpng-dev libzip-dev tidyhtml-dev

RUN docker-php-ext-configure gd && docker-php-ext-install gd zip pdo pdo_mysql tidy

RUN addgroup -g 1000 -S laravel && adduser -u 1000 -G laravel -S laravel

RUN mkdir -p /var/lib/letsencrypt && mkdir -p /var/log/letsencrypt && mkdir -p /etc/letsencrypt

RUN chown -R laravel:laravel /var/lib/letsencrypt && chown -R laravel:laravel /var/log/letsencrypt && chown -R laravel:laravel /etc/letsencrypt

COPY --from=composer:2.5.4 /usr/bin/composer /usr/bin/composer

COPY php.ini /usr/local/etc/php/

COPY www.conf /usr/local/etc/php-fpm.d/www.conf
