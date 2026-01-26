#!/bin/bash
set -e

# ----------------------------
# Docker Entrypoint for Laravel
# ----------------------------

echo "Starting Laravel setup..."

# 1️⃣ Set permissions for storage and cache
echo "Setting permissions..."
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# 2️⃣ Generate app key if not exists
if [ ! -f /var/www/html/.env ]; then
    echo ".env file not found! Copying .env.example..."
    cp /var/www/html/.env.example /var/www/html/.env
fi

if ! grep -q "APP_KEY=" /var/www/html/.env || [ -z "$(grep 'APP_KEY=' /var/www/html/.env | cut -d '=' -f2)" ]; then
    echo "Generating APP_KEY..."
    php /var/www/html/artisan key:generate
fi

# 3️⃣ Clear & cache config, routes, views
echo "Caching config, routes, and views..."
php /var/www/html/artisan config:clear
php /var/www/html/artisan config:cache
php /var/www/html/artisan route:cache
php /var/www/html/artisan view:cache

# 4️⃣ Run migrations and seed database (no interaction)
echo "Running migrations and seeders..."
php /var/www/html/artisan migrate --force
php /var/www/html/artisan db:seed --force

# 5️⃣ Start Apache in foreground
echo "Starting Apache..."
exec apache2-foreground
