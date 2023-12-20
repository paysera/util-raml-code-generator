FROM php:7.4.33-cli

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
RUN composer self-update --1

RUN apt-get update && apt-get install git zip -y
