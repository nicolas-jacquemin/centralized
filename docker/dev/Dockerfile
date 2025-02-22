FROM dunglas/frankenphp:1.3-php8.3-bookworm

RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    nodejs \
    npm

RUN npm install --save-dev chokidar

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN install-php-extensions \
    pcntl \
    pdo_mysql \
    pdo_pgsql \
    zip \
    xdebug

RUN cp $PHP_INI_DIR/php.ini-development $PHP_INI_DIR/php.ini && \
sed -i 's/memory_limit = 128M/memory_limit = 512M/g' $PHP_INI_DIR/php.ini && \
sed -i 's/post_max_size = 8M/post_max_size = 1024M/g' $PHP_INI_DIR/php.ini && \
sed -i 's/upload_max_filesize = 2M/upload_max_filesize = 100M/g' $PHP_INI_DIR/php.ini
RUN echo "xdebug.mode=develop,debug,coverage" >> $PHP_INI_DIR/php.ini

COPY ./docker/dev/entrypoint.sh /usr/local/bin/entrypoint.sh

RUN chmod +x /usr/local/bin/entrypoint.sh

ENTRYPOINT ["entrypoint.sh"]
