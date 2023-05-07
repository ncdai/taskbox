FROM php:7.4-apache

# Install MySQL and PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copy PHP code to the container
COPY ./taskbox /var/www/html/

# Set up Apache configuration
RUN a2enmod rewrite

# Install phpMyAdmin
ARG PMA_VERSION=5.1.1
RUN apt-get update && \
    apt-get install -y wget && \
    wget https://files.phpmyadmin.net/phpMyAdmin/${PMA_VERSION}/phpMyAdmin-${PMA_VERSION}-all-languages.tar.gz && \
    tar xzf phpMyAdmin-${PMA_VERSION}-all-languages.tar.gz && \
    mv phpMyAdmin-${PMA_VERSION}-all-languages /var/www/html/phpmyadmin && \
    rm phpMyAdmin-${PMA_VERSION}-all-languages.tar.gz

# Expose ports for Apache and MySQL
EXPOSE 80
EXPOSE 3306

# Start Apache
CMD ["apache2-foreground"]
