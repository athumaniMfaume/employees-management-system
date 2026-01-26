# ----------------------------
# Base Image: PHP 8.2 + Apache
# ----------------------------
FROM php:8.2-apache

ARG DEBIAN_FRONTEND=noninteractive

# ----------------------------
# Install system dependencies + PHP extensions
# ----------------------------
RUN apt-get update && apt-get install -y \
    libpng-dev libonig-dev libxml2-dev zip unzip git curl \
    libpq-dev libzip-dev zlib1g-dev libicu-dev \
    && docker-php-ext-install pdo_mysql pdo_pgsql mbstring exif pcntl bcmath gd zip intl \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# ----------------------------
# Enable Apache rewrite & PHP module
# ----------------------------
RUN a2enmod rewrite
RUN a2enmod php8.2

# ----------------------------
# Set Apache DocumentRoot to Laravel's public folder
# ----------------------------
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -i "s!/var/www/html!${APACHE_DOCUMENT_ROOT}!g" /etc/apache2/sites-available/000-default.conf \
    && echo "ServerName localhost" >> /etc/apache2/apache2.conf

# ----------------------------
# Set working directory
# ----------------------------
WORKDIR /var/www/html

# ----------------------------
# Copy project files
# ----------------------------
COPY . .

# ----------------------------
# Copy composer from official image
# ----------------------------
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# ----------------------------
# Install Laravel dependencies
# ----------------------------
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

# ----------------------------
# Set permissions
# ----------------------------
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# ----------------------------
# Copy entrypoint script
# ----------------------------
COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# ----------------------------
# Expose port 80
# ----------------------------
EXPOSE 80

# ----------------------------
# Entrypoint
# ----------------------------
ENTRYPOINT ["docker-entrypoint.sh"]
