# Use an official PHP runtime as a parent image
FROM php:8.1-apache

# Set working directory
WORKDIR /var/www/html

# Install required system packages
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql pgsql \
    && docker-php-ext-enable pdo_pgsql

# Install Composer globally
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy project files to the container
COPY . .

# Ensure storage and cache directories exist
RUN mkdir -p /var/www/html/storage /var/www/html/bootstrap/cache

# Set correct permissions
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache \
    && chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Install PHP dependencies with Composer
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist || \
    (composer clear-cache && composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist)

# Enable Apache Rewrite Module
COPY ./.htaccess /var/www/html/.htaccess
RUN a2enmod rewrite

# Expose port 80
EXPOSE 80

# Start the Apache server
CMD ["apache2-foreground"]
