# Use the official PHP 8.3 FPM image as the base image
FROM php:8.3-fpm

# Define build arguments for user and user ID
ARG user
ARG uid

# Install necessary packages and dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Clean up the apt cache to reduce image size
RUN apt-get clean

# Install PHP extensions required for the application
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Copy the Composer binary from the Composer image
COPY --from=composer:2.8 /usr/bin/composer /usr/bin/composer

# Create a new user with the specified UID and set the default shell to bash
RUN useradd -u $uid -ms /bin/bash -g www-data $user

# Copy the application source code into the container
COPY . /var/www

# Change ownership of the copied files to the specified user and the www-data group
COPY --chown=$user:www-data . /var/www

# Switch to the newly created user
USER $user

# Command to run PHP-FPM when the container starts
CMD ["php-fpm"]
