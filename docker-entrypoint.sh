#!/bin/bash
set -e

echo "Starting Laravel setup..."

# Ensure image directory exists with correct permissions
mkdir -p /var/www/html/public/images
chown -R www-data:www-data /var/www/html/public/images
chmod -R 775 /var/www/html/public/images

# Set permissions for storage and cache
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Only use .env.example if no real environment variables are set by Render
if [ ! -f /var/www/html/.env ]; then
    echo "Creating .env from example..."
    cp /var/www/html/.env.example /var/www/html/.env
fi

# Run migrations automatically
# The --force flag is required for production environments
echo "Running migrations..."
php /var/www/html/artisan migrate --force

# Cache config/routes/views for performance
php /var/www/html/artisan config:cache
php /var/www/html/artisan route:cache
php /var/www/html/artisan view:cache

echo "Starting Apache..."
exec apache2-foreground



