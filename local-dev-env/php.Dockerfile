FROM php:8.3.6-apache

# Install PDO MySQL PHP extension
RUN docker-php-ext-install pdo_mysql

# Set the document root to the 'public' directory
ENV APACHE_DOCUMENT_ROOT /var/www/html/src

# Update the Apache configuration to use the new document root
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}/!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Install Composer
RUN apt-get update && apt-get install -y zip unzip \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
