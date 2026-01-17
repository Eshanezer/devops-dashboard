# Use the official PHP 8.3 image with PHP-FPM
# PHP-FPM is the standard process manager for PHP applications
FROM php:8.3-fpm

# Install system-level dependencies required by Laravel and Composer
# - git: used by Composer to fetch dependencies
# - curl: used for HTTP requests and health checks
# - unzip: required for extracting Composer packages
# - libzip-dev: required to compile the PHP zip extension
RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    libzip-dev \
    && docker-php-ext-install zip pdo pdo_mysql

# Copy the Composer binary from the official Composer image
# This avoids installing Composer manually and keeps the image clean
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set the working directory inside the container
# Laravel source code will live in /var/www
WORKDIR /var/www

# Copy custom entrypoint script into the container
# This script is responsible for one-time initialization logic
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh

# Make the entrypoint script executable
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# ENTRYPOINT is the main container startup process
# It always runs when the container starts
ENTRYPOINT ["docker-entrypoint.sh"]

# CMD defines the default command that ENTRYPOINT will execute
# This starts the Laravel development server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
