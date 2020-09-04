FROM php:7.3.2-apache-stretch

COPY --chown=www-data:www-data . /srv/app

COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf

WORKDIR /srv/app

EXPOSE 80

RUN apt-get update && apt-get install -y \
    zlib1g-dev \
    libzip-dev \
    unzip

RUN docker-php-ext-install mbstring pdo pdo_mysql zip \
    && a2enmod rewrite negotiation \
    && docker-php-ext-install opcache

RUN cd /srv/app
RUN chmod -R 777 storage/
