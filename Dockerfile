FROM php:7.4-apache

# Install MySQL and PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copy PHP code to the container
COPY ./taskbox /var/www/html/

# Set up Apache configuration
RUN a2enmod rewrite

# Expose ports for Apache and MySQL
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
