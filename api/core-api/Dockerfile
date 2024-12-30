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

RUN ./initialize.sh

CMD ["php", "artisan", "octane:frankenphp", "--port", "8002"]
