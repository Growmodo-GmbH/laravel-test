FROM php:8.1-fpm

# Arguments defined in docker-compose.yml
USER root

# Set working directory
WORKDIR /var/www

ARG user
ARG uid

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    nodejs \
    npm \
    libpq-dev \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libcurl4-openssl-dev

# Clear Cache
RUN apt-get autoclean -y \
    && rm -rf /var/lib/apt/lists/* \
    && rm -rf /tmp/pear/

# Configure PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath zip curl xml gd

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user

RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

RUN chmod +rwx /var/www

RUN chmod -R 777 /var/www

# Laravel and Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

USER $user

CMD [ "sh", "./.devcontainer/init_setup.sh" ]