
FROM php:8.5-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libsqlite3-dev \
    libzip-dev \
    libonig-dev \
    && docker-php-ext-install pdo_sqlite zip mbstring \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy backend files
COPY . .

# Install PHP dependencies
RUN composer install --no-interaction --prefer-dist

# Expose Laravel port
EXPOSE 8000

# Start Laravel server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
