FROM php:8.2-alpine3.17

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
    gd \
    zip \
  && apk add supervisor

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

RUN addgroup -g ${PGID} www && \
  adduser -D -G www -u ${PUID} www

#
#--------------------------------------------------------------------------
# Optional Supervisord Configuration
#--------------------------------------------------------------------------
#
# Modify the ./supervisor.conf file to match your App's requirements.
# Make sure you rebuild your container with every change.
#

COPY supervisord.conf /etc/supervisord.conf
COPY supervisord.d/*.conf /etc/supervisord.d/

ENTRYPOINT ["/usr/bin/supervisord", "-n", "-c",  "/etc/supervisord.conf"]

#
#--------------------------------------------------------------------------
# Check PHP version
#--------------------------------------------------------------------------
#

RUN php -v | head -n 1 | grep -q "PHP ${PHP_VERSION}."

#
#--------------------------------------------------------------------------
# Final Touch
#--------------------------------------------------------------------------
#

# Clean up
RUN rm -rf /var/cache/apk/* \
    && mkdir -p /var/www

WORKDIR /etc/supervisor/conf.d/
