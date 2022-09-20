FROM php:8.1-fpm

RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libwebp-dev \
    libicu-dev \
    libcurl4-openssl-dev \
    nano \
    vim \
    nodejs \
    git \
    libexif-dev \
    libxrender1 \
    libfontconfig \
    libzip-dev \
    libxml2-dev \
    libxslt-dev \
    openssl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install -j$(nproc) zip intl pdo_mysql bcmath soap sockets xsl \
    && docker-php-ext-install exif \
    && rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer |  php -- --install-dir=/usr/local/bin --filename=composer
RUN mkdir /app
WORKDIR /app

#RUN yes | pecl install xdebug \
#    && echo "zend_extension=$(find  / -name xdebug.so)" > /usr/local/etc/php/7.1/conf.d/xdebug.ini \
#    && echo "xdebug.remote_enable=on" >> /usr/local/etc/php/7.1/conf.d/xdebug.ini \
#    && echo "xdebug.remote_autostart=off" >> /usr/local/etc/php/7.1/conf.d/xdebug.ini \
#    && echo "xdebug.remote_connect_back=on" >> /usr/local/etc/php/7.1/conf.d/xdebug.ini

RUN usermod -u 1000 www-data