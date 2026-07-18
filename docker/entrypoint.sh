#!/bin/sh
set -e

cd /var/www/html

echo "[entrypoint] Menunggu database siap..."
ATTEMPTS=0
until php artisan db:show > /dev/null 2>&1 || [ $ATTEMPTS -eq 20 ]; do
    ATTEMPTS=$((ATTEMPTS+1))
    echo "[entrypoint] DB belum siap, percobaan $ATTEMPTS/20..."
    sleep 3
done

echo "[entrypoint] Cache config, route, view..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "[entrypoint] Menjalankan migrasi..."
php artisan migrate --force

if [ ! -L /var/www/html/public/storage ]; then
    echo "[entrypoint] Membuat symlink storage..."
    php artisan storage:link
fi

PORT="${PORT:-8080}"
echo "[entrypoint] Menjalankan server di 0.0.0.0:${PORT}..."
exec php artisan serve --host=0.0.0.0 --port="${PORT}"
