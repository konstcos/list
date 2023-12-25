FROM php:8.2-fpm-alpine3.17

ARG APP_ENV="prod"

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN apk add --update --no-cache mysql-client bash \
  && chmod +x /usr/local/bin/install-php-extensions \
  && IPE_GD_WITHOUTAVIF=1 install-php-extensions \
    mysqli \
    mbstring \
    pdo \
    pdo_mysql \
    tokenizer \
    xml \
    exif \
    pcntl \
    imagick \
    redis \
    gd \
    zip \
    @composer-2.5.4 \
    \
  && if [ ${APP_ENV} = "prod" ]; then \
      install-php-extensions opcache \
    ;fi \
    \
  && if [ ${APP_ENV} = "dev" ]; then \
      # Install the xdebug extension \
      install-php-extensions xdebug-3.2.0 \
    ;fi

# Add a non-root user:
ARG PUID=1000
ENV PUID ${PUID}
ARG PGID=1000
ENV PGID ${PGID}

RUN if [ ${APP_ENV} = "dev" ]; then \
    mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini" \
;else  \
    mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini" \
;fi

COPY ./xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini
COPY ./opcache.ini /usr/local/etc/php/conf.d
COPY ./laravel.ini /usr/local/etc/php/conf.d
COPY ./xlaravel.pool.conf /usr/local/etc/php-fpm.d/

USER root

RUN echo https://dl-2.alpinelinux.org/alpine/edge/community/ >> /etc/apk/repositories
RUN apk --no-cache add shadow \
    && usermod -u ${PUID} www-data

# Clean up
RUN rm -rf /var/cache/apk/* \
    && mkdir -p /var/www

ENV LC_ALL "POSIX"

WORKDIR /var/www

CMD ["php-fpm"]

EXPOSE 9000
