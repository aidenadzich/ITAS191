FROM php:8.4-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    git \
    vim

# Install PHP extensions
RUN docker-php-ext-install zip

COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

# Copy your application code into the container
COPY . /var/www/html

# Expose port 80
EXPOSE 80