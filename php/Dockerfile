FROM php:8-fpm


RUN apt-get update && apt-get install -y \
    git \ 
    unzip \
    && docker-php-ext-install pdo_mysql 


COPY --from=composer /usr/bin/composer /usr/bin/composer
#COPY php.ini /usr/local/etc/php/php.ini
