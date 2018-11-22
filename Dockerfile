FROM php:7.2.3-apache-stretch

ENV APACHE_DOCUMENTROOT /var/www/html

RUN docker-php-ext-install pdo_mysql

# setting timezone
RUN echo "date.timezone = Europe/Prague" > /usr/local/etc/php/php.ini

# setting rights, adding executable for web server
RUN chmod -R 775 /var/www/html
