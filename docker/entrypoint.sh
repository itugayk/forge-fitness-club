#!/usr/bin/env bash
set -e

cd /var/www/html

# Eski/yerelden gelmiş önbelleğe alınmış manifest & config'leri temizle
# (yerel dev'de kurulan laravel/pail gibi dev paketleri prod imajında yok)
rm -f bootstrap/cache/packages.php bootstrap/cache/services.php \
      bootstrap/cache/config.php bootstrap/cache/routes-*.php

# .env yoksa örnekten oluştur (env değişkenleri zaten compose'tan gelir)
if [ ! -f .env ]; then
    cp .env.example .env
fi

# APP_KEY yoksa üret
if [ -z "${APP_KEY}" ] && ! grep -q "^APP_KEY=base64" .env; then
    php artisan key:generate --force
fi

# Veritabanını bekle
echo "⏳ Veritabanı bekleniyor..."
until php -r '
    $h = getenv("DB_HOST") ?: "mysql";
    $p = getenv("DB_PORT") ?: 3306;
    $u = getenv("DB_USERNAME") ?: "forge";
    $pw = getenv("DB_PASSWORD") ?: "";
    $db = getenv("DB_DATABASE") ?: "forge_fitness";
    try { new PDO("mysql:host=$h;port=$p;dbname=$db", $u, $pw); exit(0); }
    catch (Throwable $e) { exit(1); }
' 2>/dev/null; do
    sleep 2
    echo "   ...hazır değil, tekrar deneniyor"
done
echo "✅ Veritabanı hazır."

# Migrasyon + (idempotent) seed
php artisan migrate --force --seed

# Storage symlink
php artisan storage:link || true

# Production cache (config + route + view)
php artisan optimize

echo "🚀 Forge Fitness Club başlatılıyor..."
exec "$@"
