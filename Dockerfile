FROM php:8.2-apache

RUN apt-get update && apt-get install -y libpq-dev libzip-dev git python3 python3-pip \
    && docker-php-ext-install pdo pdo_pgsql pgsql \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && a2enmod rewrite \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* \
    # Instala Composer, gestor de dependencias de PHP
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


WORKDIR /var/www/html/

COPY . /var/www/html/

# Ejecuta Composer para instalar las dependencias
# genera carpeta vendor con las dependencias
RUN composer install


RUN cd src/utils && pip3 install --break-system-packages -r requirements.txt
EXPOSE 80
