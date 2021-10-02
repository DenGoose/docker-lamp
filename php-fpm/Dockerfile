FROM php:7.4.24-fpm-alpine

# Установка важных пакетов
RUN apk add --update --no-cache \
    bash curl wget rsync ca-certificates openssl openssh git tzdata openntpd \
    libxrender fontconfig libc6-compat \
    mysql-client gnupg binutils-gold autoconf \
    g++ gcc gnupg libgcc linux-headers make python3 py3-pip nano

# Установка composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer \
 && chmod 755 /usr/bin/composer

# Установка сторонних PHP библиотек
RUN docker-php-ext-install bcmath pdo_mysql mysqli opcache

# Дабавляем конфиг opcache в php.ini
COPY opcache.ini /usr/local/etc/php/conf.d/opcache.ini
COPY . /var/www/html

# Добавим кастомный php.ini
ADD php.ini /usr/local/etc/php/conf.d/my-custom.ini

# Создадим каталог для сессий и логов
RUN mkdir /tmp/php_sessions
RUN chmod 777 /tmp/php_sessions
RUN mkdir /var/log/php-fpm

# Установка библиотек для компиляции GD и билд их
RUN apk add --no-cache freetype libpng libjpeg-turbo freetype-dev libpng-dev libjpeg-turbo-dev \
 && docker-php-ext-install gd \
 && apk del --no-cache freetype-dev libpng-dev libjpeg-turbo-dev

# Добавление поддержки ZIP
RUN apk add --update --no-cache zlib-dev libzip-dev \
 && docker-php-ext-install zip

# Установка xdebug
RUN pecl install xdebug \
 && docker-php-ext-enable xdebug

# Добавление конфига xdebug'а
ADD xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

WORKDIR /www