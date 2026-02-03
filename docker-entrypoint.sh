#!/bin/bash
set -e

echo "Starting Laravel setup..."

# Copy .env if missing
if [ ! -f /var/www/html/.env ]; then
    cp /var/www/html/.env.example /var/www/html/.env
fi

# Generate APP_KEY if missing
if ! grep -q "APP_KEY=" /var/www/html/.env || [ -z "$(grep 'APP_KEY=' /var/www/html/.env | cut -d '=' -f2)" ]; then
    php /var/www/html/artisan key:generate
fi

# Clear and cache config, routes, views
php /var/www/html/artisan config:clear
php /var/www/html/artisan config:cache
php /var/www/html/artisan route:cache
php /var/www/html/artisan view:cache

# Ensure images and storage permissions
mkdir -p /var/www/html/public/images
chown -R www-data:www-data /var/www/html/public/images /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 755 /var/www/html/public/images
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

echo "Laravel setup complete. Starting Apache..."
exec "$@"
