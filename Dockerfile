FROM php:8.0.0RC3-fpm-alpine

RUN apk --update --no-cache add git
RUN docker-php-ext-install pdo_mysql

COPY --from=composer /usr/bin/composer /usr/bin/composer

COPY    composer.json /var/www
COPY    composer.lock /var/www

WORKDIR /var/www

CMD composer install ;  php-fpm

EXPOSE 9000