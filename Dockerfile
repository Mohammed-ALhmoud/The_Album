FROM php:8.2-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libsqlite3-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    nodejs \
    npm

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_sqlite zip

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy project files to container
COPY . /var/www

# Create data directory for SQLite
RUN mkdir -p /var/data
RUN touch /var/data/database.sqlite
RUN chown -R www-data:www-data /var/data

# Install Laravel dependencies
RUN composer install --optimize-autoloader

# Generate application key if not set
RUN php artisan key:generate --force

# Run migrations
RUN php artisan migrate --force

# Set appropriate permissions
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Expose port
EXPOSE 10000

# Start Laravel server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=10000"]