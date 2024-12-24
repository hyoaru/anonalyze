FROM dunglas/frankenphp:php8.3

RUN install-php-extensions \
	pdo_mysql \
	gd \
	intl \
	zip \
	opcache \
    pcntl

COPY . /app

CMD ["php", "artisan", "octane:frankenphp", "--port", "8005"]
