# استخدام إصدار 8.4 لحل مشاكل التوافق مع Pest و Laravel 12
FROM php:8.4-fpm

# تثبيت الإضافات الضرورية التي طلبها Composer (intl, zip, gd)
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libicu-dev \
    libzip-dev \
    zip \
    git \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql gd intl zip

# تثبيت Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

# تثبيت المكتبات مع تجاهل متطلبات المنصة في حالة وجود تعارض بسيط
RUN composer install --no-dev --optimize-autoloader

EXPOSE 8080
CMD php artisan serve --host=0.0.0.0 --port=8080