FROM php:8.2-apache
# Usa la imagen base php:8.2-apache

RUN apt-get update && apt-get install -y libpq-dev \
    # Actualiza el repositorio de paquetes e instala libpq-dev
    && docker-php-ext-install pdo pdo_pgsql pgsql \
    # Instala extensiones de PHP necesarias para PostgreSQL
    && a2enmod rewrite
    # Habilita el módulo de Apache rewrite

WORKDIR /var/www/html
# Establece el directorio de trabajo dentro del contenedor