# ====== PHP build ======
FROM php:8.3-fpm-alpine

RUN apk add --no-cache \
    bash curl git unzip \
    icu-dev oniguruma-dev libzip-dev \
    && docker-php-ext-install intl mbstring zip pdo pdo_mysql pdo_pgsql

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

# Install PHP deps (no dev)
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Laravel permissions
RUN mkdir -p storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Render will set PORT; we’ll use PHP built-in server for simplicity
CMD php -S 0.0.0.0:${PORT} -t public
