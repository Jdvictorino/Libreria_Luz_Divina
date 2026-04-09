FROM php:8.2-apache

# Enable Apache mod_rewrite module
RUN a2enmod rewrite

# Install PDO and PDO_MySQL extensions for database connectivity
RUN docker-php-ext-install pdo pdo_mysql

# Configure Apache to listen on the port provided by Render (or default to 80)
ENV PORT=80
RUN sed -i 's/80/${PORT}/g' /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf

# Copy the application code to the Apache web directory
COPY . /var/www/html/

# Set appropriate permissions for the web server user
RUN chown -R www-data:www-data /var/www/html/
