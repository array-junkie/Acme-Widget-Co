# Use the latest Alpine Linux image as the base
FROM alpine:3.19

# Update the package lists
RUN apk update

# Install the PHP 8.2 development packages and required dependencies
RUN apk add --no-cache \
    bash \
    unzip \
    php82 \
    php82-bcmath \
    php82-bz2 \
    php82-cli \
    php82-common \
    php82-ctype \
    php82-curl \
    php82-dom \
    php82-dev \
    php82-exif \
    php82-fileinfo \
    php82-gd \
    php82-gmp \
    php82-iconv \
    php82-intl \
    php82-json \
    php82-mbstring \
    php82-mongodb \
    php82-mysqli \
    php82-opcache \
    php82-openssl \
    php82-pdo \
    php82-phar \
    php82-redis \
    php82-session \
    php82-simplexml \
    php82-tokenizer \
    php82-xdebug \
    php82-xml \
    php82-xmlreader \
    php82-xmlwriter \
    php82-zip \
    php-json \
    php-pdo \
    php-pear \
    php-pdo_mysql \
    php-pdo_pgsql \
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
