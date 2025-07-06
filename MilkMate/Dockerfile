FROM php:8.2-apache

WORKDIR /var/milkmate

# Install PHP mysqli
RUN docker-php-ext-install mysqli

# Copy your files
COPY ./data/ /var/www/html
COPY ./data/main.sh /var/milkmate/main.sh

# Make main.sh executable
RUN chmod +x /var/milkmate/main.sh
