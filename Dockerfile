# Use official PHP + Apache image
FROM php:8.2-apache

# Enable Apache modules (rewrite in case you need routes later)
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy project into container
COPY . /var/www/html/

# Change Apache root to /var/www/html/public
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf \
    && sed -i 's|<Directory /var/www/html>|<Directory /var/www/html/public>|g' /etc/apache2/apache2.conf

# Give proper permissions
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
