FROM dunglas/frankenphp:php8.3

# Install necessary PHP extensions
RUN install-php-extensions \
    pdo_mysql \
    gd \
    intl \
    zip \
    opcache \
    pcntl

# Install procps package to use `ps`
RUN apt-get update && apt-get install -y procps

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --version=2.8.4 && mv composer.phar /usr/local/bin/composer

WORKDIR /app
COPY . .

# Set permissions
RUN chmod -R 775 /app/storage /app/bootstrap/cache

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Laravel commands
RUN php artisan config:clear

# Run the Laravel Octane server
CMD ["php", "artisan", "octane:frankenphp", "--port", "8002"]

