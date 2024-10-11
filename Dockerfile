# Use the official PHP image with Apache
FROM php:8.0-apache

# Enable Apache mod_rewrite (optional, for clean URLs)
RUN a2enmod rewrite

# Copy the contents of your application from the local project folder
COPY . /var/www/html/

# Install necessary PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Expose port 80 for web traffic
EXPOSE 80
