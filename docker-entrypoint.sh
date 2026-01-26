#!/bin/bash
set -e

echo "Starting Laravel setup..."

# 1️⃣ Set permissions
echo "Setting permissions..."
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# 2️⃣ Copy .env if missing
if [ ! -f /var/www/html/.env ]; then
    echo ".env file not found! Copying .env.example..."
    cp /var/www/html/.env.example /var/www/html/.env
fi

# 3️⃣ Generate APP_KEY if missing
if ! grep -q "APP_KEY=" /var/www/html/.env || [ -z "$(grep 'APP_KEY=' /var/www/html/.env | cut -d '=' -f2)" ]; then
    echo "Generating APP_KEY..."
    php /var/www/html/artisan key:generate --force
fi

# 4️⃣ Cache config, routes, views
echo "Caching config, routes, and views..."
php /var/www/html/artisan config:clear
php /var/www/html/artisan config:cache
php /var/www/html/artisan route:cache
php /var/www/html/artisan view:cache

# 5️⃣ Start Apache
echo "Starting Apache..."
exec apache2-foreground
