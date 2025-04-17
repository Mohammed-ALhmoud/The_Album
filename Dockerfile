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

# Copy all files
COPY . .

# Create data directory and database file with proper permissions
RUN mkdir -p /var/data && \
    touch /var/data/database.sqlite && \
    chown -R www-data:www-data /var/data && \
    chmod 775 /var/data && \
    chmod 664 /var/data/database.sqlite

# Create .env if missing and set database path
RUN if [ ! -f .env ]; then cp .env.example .env; fi && \
    sed -i "s|DB_DATABASE=.*|DB_DATABASE=/var/data/database.sqlite|g" .env

# Install dependencies
RUN composer install --optimize-autoloader --no-dev

# Generate application key
RUN php artisan key:generate --force

# Verify database connection
RUN php artisan tinker --execute='try { DB::connection()->getPdo(); echo "DB Connected!"; } catch (\Exception $e) { exit("DB Error: ".$e->getMessage()); }'

# Run migrations
RUN php artisan migrate --force

# Set permissions
RUN chown -R www-data:www-data \
    /var/www/storage \
    /var/www/bootstrap/cache

# Build assets
RUN npm install && npm run build

# Expose port
EXPOSE 10000

# Start server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=10000"]