# Use official PHP + Apache image
FROM php:8.2-apache

# Enable Apache rewrite (future-proof for Laravel/Symfony style apps)
RUN a2enmod rewrite

# Copy project into container
COPY . /var/www/html/

# Change DocumentRoot to /public
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf \
 && echo '<Directory /var/www/html/public>\n\
    Options Indexes FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' > /etc/apache2/conf-available/public.conf \
 && a2enconf public

# Fix permissions
RUN chown -R www-data:www-data /var/www/html

# Expose port 80
EXPOSE 80
