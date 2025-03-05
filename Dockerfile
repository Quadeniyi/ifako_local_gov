# Use official PHP image with Apache
FROM php:8.2-apache

# Set working directory
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpq-dev \
    unzip \
    && docker-php-ext-install pdo pdo_pgsql pgsql

# Enable Apache mod_rewrite (important for CodeIgniter)
RUN a2enmod rewrite

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application source
COPY . /var/www/html

# Set permissions
RUN mkdir -p /var/www/html/storage /var/www/html/bootstrap/cache && \
    chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

RUN mkdir -p /var/www/html/vendor && \
    composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

RUN chmod -R 777 /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port 10000 for PHP built-in server
EXPOSE 10000

# Start the PHP built-in server
CMD ["php", "-S", "0.0.0.0:10000", "-t", "/var/www/html"]
