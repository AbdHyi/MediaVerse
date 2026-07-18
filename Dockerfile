# syntax=docker/dockerfile:1
FROM php:8.3-cli

WORKDIR /var/www/html

# System deps + PHP extensions yang dibutuhkan Laravel 13 + MySQL
RUN apt-get update && apt-get install -y \
        git unzip curl libzip-dev libonig-dev libxml2-dev libicu-dev \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath intl \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Install dependency PHP dulu (cache layer terpisah dari source code)
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-interaction --prefer-dist --optimize-autoloader

# Install dependency Node terpisah juga (cache layer)
COPY package.json package-lock.json* ./
RUN npm install

# Baru copy seluruh source code (vendor/ dari composer sudah ada duluan,
# supaya tailwind.config.js yang scan vendor/laravel/framework/.../Pagination bisa kebaca benar)
COPY . .

RUN npm run build && rm -rf node_modules

# storage & bootstrap/cache harus writable
RUN mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views storage/logs storage/app/public bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

RUN composer dump-autoload --optimize \
    && php artisan package:discover --ansi || true

COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 8080
ENTRYPOINT ["entrypoint.sh"]
