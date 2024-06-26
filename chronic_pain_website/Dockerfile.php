# Use an image packaging php
FROM php:8.2-apache

# Update package lists and upgrade installed packages
RUN apt-get update && apt-get upgrade -y

# Install PHP extensions required for mysqli, pdo, and pdo_mysql
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable mysqli pdo_mysql

RUN apt-get install -y wget git unzip

# Download and install Composer
RUN wget https://getcomposer.org/installer -O composer-setup.php \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && rm composer-setup.php

# Copy the files of the app into the container
COPY login.html /var/www/html
COPY inscription.html /var/www/html
COPY formulaire.html /var/www/html
COPY patient_answers.html /var/www/html
COPY patient_recap.html /var/www/html
COPY physician_page.html /var/www/html
COPY accueil.html /var/www/html
COPY ./sources/css /var/www/html/sources/css
COPY ./sources/js /var/www/html/sources/js
COPY ./sources/php /var/www/html/sources/php
COPY ./sources/images /var/www/html/sources/images

COPY ./composer.json /var/www/html/
COPY ./composer.lock /var/www/html/

RUN composer install

# Expose port 80 for web traffic
EXPOSE 80

# Clean up the package cache to reduce image size
RUN apt-get clean
