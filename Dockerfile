# PHP 8.2 + Apache (CI4.7 requires PHP 8.2+)
FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git zip unzip curl \
    libpng-dev libjpeg62-turbo-dev libfreetype6-dev \
    libonig-dev libxml2-dev libzip-dev libicu-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install intl pdo_mysql mysqli gd mbstring zip exif pcntl bcmath opcache \
    && docker-php-ext-enable intl \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Enable Apache modules used by .htaccess
RUN a2enmod rewrite headers

# Configure Apache DocumentRoot
ARG APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e "s!/var/www/html!${APACHE_DOCUMENT_ROOT}!g" /etc/apache2/sites-available/000-default.conf /etc/apache2/apache2.conf

# Copy Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy all project files into the container
COPY . .

# Install Composer dependencies (without interaction)
RUN composer install --no-interaction --prefer-dist --optimize-autoloader || true

# Ensure storage and bootstrap cache directories are writable
#RUN chmod -R 777 storage bootstrap/cache

# Create .env if not exists and generate key
RUN if [ ! -f .env ]; then cp .env.example .env; fi && \
    php artisan key:generate || true


# Expose Apache HTTP port
EXPOSE 80

# Start Apache in foreground
CMD ["apache2-foreground"]
