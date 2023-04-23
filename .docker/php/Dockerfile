FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && \
    apt-get install -y vim && \
    apt-get install -y nano && \
    apt-get install -y curl && \
    apt-get install -y wget && \
    apt-get install -y zip && \
    apt-get install -y unzip && \
    apt-get install -y git && \
    apt-get install -y openssl && \
    apt-get install -y bash && \
    apt-get install -y htop

RUN apt-get install -y --no-install-recommends \
        libmemcached-dev \
        libz-dev \
        libpq-dev \
        libjpeg-dev \
        libfreetype6-dev \
        libssl-dev \
        libmcrypt-dev

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql exif pcntl bcmath opcache sockets


# Add GD
RUN docker-php-ext-configure gd && \
    docker-php-ext-install -j"$(getconf _NPROCESSORS_ONLN)" gd && \
    docker-php-ext-enable gd

# Get latest Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --version=2.1.11 && chmod +x /usr/local/bin/composer

# Configure user
RUN groupadd -g 1000 test-logcomex && \
useradd -u 1000 -g test-logcomex -G www-data -m test-logcomex && \
usermod -p "*" test-logcomex -s /bin/bash && \
usermod -a -G www-data test-logcomex

# Define work directory
WORKDIR /var/www

# Remove unnecessary directory
RUN rm -rf /var/www/html

# Copy php.ini to the final directory
COPY ./php.ini.development "$PHP_INI_DIR/php.ini"

# Create symbolic link
RUN ln -s public html

# Expose port
EXPOSE 9000

# Define entrypoint
ENTRYPOINT ["php-fpm"]
