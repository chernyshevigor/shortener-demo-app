#------- BASE -------
FROM php:8.2-fpm AS base

RUN apt-get update && apt-get install -y --no-install-recommends \
    ssh \
    git \
    sudo \
    locales \
    libzip-dev \
    libgmp-dev \
    libicu-dev \
    libpq-dev \
    unzip \
    nano \
    mc \
    iputils-ping \
    htop

RUN docker-php-ext-install zip \
    pdo \
    pdo_mysql \
    intl gmp opcache sockets \
    && docker-php-ext-configure intl \
    && docker-php-ext-enable opcache

RUN sed -i -e \
  's/# ru_RU.UTF-8 UTF-8/ru_RU.UTF-8 UTF-8/' /etc/locale.gen \
   && locale-gen

ENV LANG ru_RU.UTF-8
ENV LANGUAGE ru_RU:ru
ENV LC_LANG ru_RU.UTF-8
ENV LC_ALL ru_RU.UTF-8

ENV TZ="UTC"

COPY --from=composer:2.3.10 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

ENV PATH="$PATH:/var/www/vendor/bin:/var/www/bin"

COPY ./docker/php/symfony.ini $PHP_INI_DIR/conf.d/symfony.ini
COPY ./docker/php/symfony-fpm-pool.conf $PHP_INI_DIR/../php-fpm.d/www.conf
COPY ./composer.json /var/www/composer.json
COPY ./composer.lock /var/www/composer.lock
COPY ./symfony.lock /var/www/symfony.lock
COPY ./bin/ /var/www/bin/
COPY ./config/ /var/www/config/
COPY ./public/ /var/www/public/
COPY ./src/ /var/www/src/
COPY ./.env /var/www/.env

RUN composer install --prefer-dist --no-scripts --optimize-autoloader

RUN chmod +x bin/fpm-entrypoint.sh && \
    mkdir /var/www/var && \
    rm -rf /var/www/html

ENTRYPOINT ["/bin/bash", "/var/www/bin/fpm-entrypoint.sh"]

FROM base AS dev

ENV PHP_OPCACHE_VALIDATE_TIMESTAMPS="1"
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"
RUN echo 'user = root' >> $PHP_INI_DIR/../php-fpm.d/www.conf
RUN echo 'group = root' >> $PHP_INI_DIR/../php-fpm.d/www.conf

ENV APP_ENV=dev
