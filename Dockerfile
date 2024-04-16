FROM php:8-apache

# Install required PHP extensions
RUN docker-php-ext-install mysqli

# Install Composer
RUN apt-get update && \
    apt-get install -y --no-install-recommends \
        git \
        unzip && \
    rm -rf /var/lib/apt/lists/* && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www/html

# Copy composer.json to working directory
COPY composer.json .

# Install Composer dependencies
RUN composer install
RUN composer dump-autoload --optimize

# Copy the entire application directory
COPY . .

# Copy custom Apache configuration
COPY src/custom/apache.conf /etc/apache2/sites-available/000-default.conf

# Enable Apache rewrite module
RUN a2enmod rewrite

# Expose ports
EXPOSE 80/tcp
EXPOSE 443/tcp
