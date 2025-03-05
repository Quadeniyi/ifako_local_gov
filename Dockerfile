# Use official PHP image
FROM php:8.1-apache

# Install system dependencies required for Composer and PHP extensions
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl \
    libpq-dev \
    libzip-dev \
    zip \
    && docker-php-ext-install \
    pdo \
    pdo_pgsql \
    pgsql \
    zip \
    opcache

# Set working directory
WORKDIR /var/www/html

# Copy application source code
COPY . .

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Fix permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Install PHP dependencies (Fixing previous error)
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

# Expose port 80
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
