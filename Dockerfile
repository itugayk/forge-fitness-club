# syntax=docker/dockerfile:1
# =====================================================================
#  Forge Fitness Club — Laravel 12 + Filament 3 production image
#  (nginx + php-fpm + supervisor, dijifa-laravel yapısı referans alınmıştır)
# =====================================================================

# ----- Stage 1: Composer bağımlılıkları -------------------------------
FROM composer:2 AS vendor
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install \
    --no-dev --no-scripts --no-autoloader \
    --prefer-dist --no-interaction --ignore-platform-reqs
COPY . .
RUN composer dump-autoload --optimize --no-dev --no-scripts

# ----- Stage 2: Frontend (Vite/Tailwind) build ------------------------
FROM node:20-alpine AS assets
WORKDIR /app
COPY package.json package-lock.json* ./
RUN npm ci
COPY . .
RUN npm run build

# ----- Stage 3: Runtime (PHP-FPM + nginx + supervisor) ----------------
FROM php:8.3-fpm-bookworm AS app

# Sistem bağımlılıkları + PHP eklentileri
RUN apt-get update && apt-get install -y --no-install-recommends \
        nginx supervisor \
        libpng-dev libjpeg-dev libfreetype6-dev \
        libzip-dev libonig-dev libicu-dev libxml2-dev \
        unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j"$(nproc)" \
        pdo_mysql mbstring bcmath zip gd intl opcache exif pcntl \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html

# Uygulama kaynakları + derlenmiş bağımlılıklar/varlıklar
COPY --from=vendor /app /var/www/html
COPY --from=assets /app/public/build /var/www/html/public/build

# Yapılandırma dosyaları
COPY docker/php.ini /usr/local/etc/php/conf.d/zz-forge.ini
COPY docker/nginx.conf /etc/nginx/sites-available/default
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY docker/entrypoint.sh /usr/local/bin/entrypoint
RUN chmod +x /usr/local/bin/entrypoint

# İzinler
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 80

ENTRYPOINT ["entrypoint"]
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
