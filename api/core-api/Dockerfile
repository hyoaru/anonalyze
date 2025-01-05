FROM dunglas/frankenphp:php8.3

RUN install-php-extensions \
	pdo_mysql \
	gd \
	intl \
	zip \
	opcache \
    pcntl

COPY --from=composer:2.8 /usr/bin/composer /usr/bin/composer

COPY . /app

RUN chown -R www-data:www-data /app && \
    chmod -R 775 /app && \
    chown -R www-data:www-data /app/storage && \
    chmod -R 775 /app/storage && \
    chown -R www-data:www-data /app/bootstrap/cache && \
    chmod -R 775 /app/bootstrap/cache

CMD ["php", "artisan", "octane:frankenphp", "--port", "8002"]
