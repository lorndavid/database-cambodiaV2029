FROM php:8.3-fpm-alpine

# System deps + Postgres headers (pg_config / libpq-fe.h)
RUN apk add --no-cache \
    bash curl git unzip \
    icu-dev oniguruma-dev libzip-dev \
    postgresql-dev \
    && docker-php-ext-install intl mbstring zip pdo pdo_pgsql

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

# Install PHP deps
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Laravel writable dirs
RUN mkdir -p storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Run app (Render provides PORT)
CMD php -S 0.0.0.0:${PORT} -t public

