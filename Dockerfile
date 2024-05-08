FROM php:8.2-apache

RUN apt-get update && apt-get install -y libpq-dev libzip-dev git \
    && docker-php-ext-install pdo pdo_pgsql pgsql \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && a2enmod rewrite \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html/

COPY . /var/www/html/

# Ejecuta Composer para instalar las dependencias
RUN composer install

EXPOSE 80
