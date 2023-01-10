FROM ghcr.io/blumilksoftware/php:8.1

ARG XDEBUG_VERSION=3.1.4
ARG INSTALL_XDEBUG=false

RUN if [ ${INSTALL_XDEBUG} = true ]; then \
    apk --no-cache add $PHPIZE_DEPS \
    && pecl install xdebug-${XDEBUG_VERSION} \
    && docker-php-ext-enable xdebug \
;fi

RUN set -e; \
    apk add --no-cache pcre-dev $PHPIZE_DEPS \
    zip \
    gd-dev \
    libzip-dev \
    libpng-dev \
    jpeg-dev \
    libjpeg-turbo-dev \
    freetype-dev

RUN pecl install redis \
    && docker-php-ext-enable \
    redis

RUN docker-php-ext-configure zip \
    && docker-php-ext-configure gd --with-jpeg --with-freetype \
    && set -e; docker-php-ext-install \
    zip \
    gd \
