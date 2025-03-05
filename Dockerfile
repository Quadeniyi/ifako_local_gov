# Use official PHP image
FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpq-dev \
    unzip \
    && docker-php-ext-install pdo pdo_pgsql pgsql

# Set working directory
WORKDIR /var/www/html

# Copy existing application files
COPY . .

# Give correct permissions (ignore errors if directories don't exist)
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache || true

# Expose port
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
