# Use an official PHP runtime as the base image
FROM php:7.4-apache

# Enable mod_rewrite for CodeIgniter
RUN a2enmod rewrite

# Copy project files to the container
COPY . /var/www/html/

# Set working directory
WORKDIR /var/www/html/

# Set permissions
RUN chown -R www-data:www-data /var/www/html

# Expose port 80
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
