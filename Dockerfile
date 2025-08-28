# Use official PHP + Apache image
FROM php:8.2-apache

# Enable Apache mod_rewrite (good practice for PHP apps)
RUN a2enmod rewrite

# Copy all project files into Apache web root
COPY . /var/www/html/

# Set working directory
WORKDIR /var/www/html/

# Expose port 80
EXPOSE 80
