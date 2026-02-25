FROM php:8.2-apache

ARG DEBIAN_FRONTEND=noninteractive

# Install system dependencies including PostgreSQL drivers
RUN apt-get update && apt-get install -y \
    libpng-dev libonig-dev libxml2-dev zip unzip git curl \
    libpq-dev libzip-dev zlib1g-dev libicu-dev \
    && docker-php-ext-install pdo_mysql pdo_pgsql mbstring exif pcntl bcmath gd zip intl \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Enable Apache rewrite module for Laravel routes
RUN a2enmod rewrite

# Set Apache Document Root to Laravel's public folder
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && echo '<Directory /var/www/html/public>\n    AllowOverride All\n    Require all granted\n</Directory>' >> /etc/apache2/apache2.conf

WORKDIR /var/www/html

# Copy all project files
COPY . .

# Install Composer and project dependencies
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

# Set initial permissions for key directories
RUN mkdir -p /var/www/html/public/images \
    && chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/public/images \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/public/images

# Setup Entrypoint script
COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

EXPOSE 80

ENTRYPOINT ["docker-entrypoint.sh"]
# Start Apache in the foreground
CMD ["apache2-foreground"]
