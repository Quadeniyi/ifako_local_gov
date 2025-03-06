#Use the official PHP 8.2 Apache image as base
FROM php:8.2-apache

# Set working directory
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl \
    libpq-dev \
    libzip-dev \
    zip \
    && docker-php-ext-install pdo pdo_pgsql pgsql zip

# Set environment variable for Composer to prevent memory issues
ENV COMPOSER_MEMORY_LIMIT=-1

# Install Composer globally
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Ensure necessary directories exist
RUN mkdir -p /var/www/html/vendor /var/www/html/storage /var/www/html/bootstrap/cache

# Set permissions for storage and cache directories
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Copy application files
COPY . /var/www/html

# Remove composer.lock and vendor directory (forcing a fresh install)
RUN rm -f composer.lock \
    && rm -rf vendor \
    && composer clear-cache

# Install PHP dependencies (Improved)
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist --ignore-platform-reqs --verbose \
    || (sleep 5 && composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist --ignore-platform-reqs --verbose)

# Enable Apache modules
RUN a2enmod rewrite

# Expose the default Apache port
EXPOSE 80

# Start Apache server
CMD ["apache2-foreground"]