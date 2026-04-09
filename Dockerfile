FROM php:8.2-apache

# Enable Apache mod_rewrite module
RUN a2enmod rewrite

# Install PDO and PDO_MySQL extensions for database connectivity
RUN docker-php-ext-install pdo pdo_mysql

# Copy the application code to the Apache web directory
COPY . /var/www/html/

# Set appropriate permissions for the web server user
RUN chown -R www-data:www-data /var/www/html/
