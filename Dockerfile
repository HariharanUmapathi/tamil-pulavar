# 
# Create php-fpm service using this
# Using Alpine php fpm version as base image
FROM php:8.3.14-fpm-alpine
# Installing php and mysqli extension for database connectivity 
RUN apk add --no-cache $PHPIZE_DEPS mariadb-dev \
    && docker-php-ext-install mysqli \
    && docker-php-ext-enable mysqli
