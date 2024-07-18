FROM php:8.3-fpm

ARG user=1000
ARG uid=1000

RUN apt-get update && apt-get install -y \
    git \
    libzip-dev

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN docker-php-ext-install pdo_mysql zip

RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

WORKDIR /var/www

USER $user
