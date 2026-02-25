#!/bin/bash
set -e

echo "Starting Laravel setup..."

# Create directory if it doesn't exist and set permissions
mkdir -p /var/www/html/public/images
chown -R www-data:www-data /var/www/html/public/images
chmod -R 775 /var/www/html/public/images

# Set permissions for storage and cache
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Copy .env if missing
if [ ! -f /var/www/html/.env ]; then
    cp /var/www/html/.env.example /var/www/html/.env
fi

# Generate APP_KEY if missing
if ! grep -q "APP_KEY=" /var/www/html/.env || [ -z "$(grep 'APP_KEY=' /var/www/html/.env | cut -d '=' -f2)" ]; then
    php /var/www/html/artisan key:generate
fi

# Cache config/routes/views for performance
php /var/www/html/artisan config:cache
php /var/www/html/artisan route:cache
php /var/www/html/artisan view:cache

# --- DATABASE SETUP ---
# The --seed flag runs your DatabaseSeeder
echo "Running migrations and seeding database..."
php /var/www/html/artisan migrate --seed --force

echo "Starting Apache..."
exec apache2-foreground
