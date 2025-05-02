#  linux avec Apache et PHP 8.3
FROM php:8.3-apache

# Ajout d'un argument pour spécifier l'environnement
ARG MODE=test

# Installation des dépendances PHP
RUN apt-get update && apt-get install -y \
    libfreetype-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    zlib1g-dev \
    libzip-dev \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install zip \
    && docker-php-ext-install mysqli pdo pdo_mysql

# Copie des fichiers locaux vers le conteneur
COPY . /var/www/app
# répertoire courant
WORKDIR /var/www/app

# Copie de l'environnement 
COPY .env.${MODE} /var/www/app/.env
COPY vhost.conf /etc/apache2/sites-available/000-default.conf

RUN a2enmod rewrite headers env dir mime authz_host authz_core

RUN chown -R www-data:www-data /var/www/app \
    && chmod -R 775 /var/www/app/storage

# Installation de composer
ENV COMPOSER_ALLOW_SUPERUSER=1
COPY --from=composer:2.6.5 /usr/bin/composer /usr/local/bin/composer

# Installation des dépendances
COPY composer.json ./
RUN composer install

RUN php artisan storage:link || true