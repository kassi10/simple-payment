FROM php:7.4-cli
WORKDIR /var/www/

COPY . .
RUN apt-get update && \
    apt-get install libzip-dev -y && \
    docker-php-ext-install zip 

RUN apt-get install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');" 
    
RUN php composer.phar create-project --prefer-dist laravel/laravel laravel

RUN apt-get install -y iputils-ping
# RUN php artisan key:generate
EXPOSE 8000
ENTRYPOINT [ "php", "artisan", "serve"]
CMD [ "--host=0.0.0.0"]
