FROM dunglas/frankenphp:1.3-php8.3-bookworm

RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    supervisor \
    cron \
    telnet \
    nodejs \
    npm

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN install-php-extensions \
    pcntl \
    pdo_mysql \
    zip

RUN cp $PHP_INI_DIR/php.ini-production $PHP_INI_DIR/php.ini && \
sed -i 's/memory_limit = 128M/memory_limit = 512M/g' $PHP_INI_DIR/php.ini && \
sed -i 's/post_max_size = 8M/post_max_size = 1024M/g' $PHP_INI_DIR/php.ini && \
sed -i 's/upload_max_filesize = 2M/upload_max_filesize = 100M/g' $PHP_INI_DIR/php.ini

COPY ./docker/prod/entrypoint.sh /usr/local/bin/entrypoint.sh
COPY ./docker/prod/worker.conf /etc/supervisor/conf.d/worker.conf
COPY ./docker/prod/schedule.conf /etc/supervisor/conf.d/schedule.conf
COPY ./docker/prod/schedule_entrypoint.sh /usr/local/bin/schedule_entrypoint.sh

RUN chmod +x /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/schedule_entrypoint.sh

COPY . /app

RUN composer install

RUN npm run build

ENTRYPOINT ["entrypoint.sh"]
