FROM php:7.4-apache
RUN apt-get update \
    && apt-get install -y wget git vim\
    && pecl install xdebug-3.0.3  \
    && docker-php-ext-enable xdebug \
    && curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer \
    && chmod +x /usr/local/bin/composer \
    && wget -O phpunit https://phar.phpunit.de/phpunit-9.phar \
    && mv phpunit /usr/local/bin/phpunit \
    && chmod +x /usr/local/bin/phpunit
COPY php.ini  /usr/local/etc/php/php.ini
#RUN composer init \
