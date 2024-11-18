# Use the latest Alpine Linux image as the base
FROM alpine:3.19

# Update the package lists
RUN apk update

# Install the PHP 8.2 development packages and required dependencies
RUN apk add --no-cache \
    bash \
    unzip \
    php82 \
    php82-ctype \
    php82-iconv \
    php82-mbstring \
    php82-openssl \
    php82-phar \
    php82-tokenizer \
    php82-xml \
    php82-xmlreader \
    php82-xmlwriter \
    php-json \
    php-pear \
    && rm -rf /var/cache/apk/*

# Set the working directory
WORKDIR /php/app

# Copy the application code
COPY . .

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install PHP dependencies
RUN composer install --optimize-autoloader

# Start Apache
CMD ["php", "index.php"]
