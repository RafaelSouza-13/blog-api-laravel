FROM laravelsail/php82-composer

RUN apt-get update && apt-get install -y \
    zip unzip git curl libzip-dev libpng-dev libpq-dev \
    && docker-php-ext-install pdo_pgsql

WORKDIR /var/www/html
COPY . .

RUN composer install

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage

# Porta padrão
EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
