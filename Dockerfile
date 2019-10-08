FROM php:7.2-cli
RUN curl -sS https://getcomposer.org/installer | \
    php -- --install-dir=/usr/bin/ --filename=composer
RUN apt-get update && apt-get install -y git zip unzip
WORKDIR /app
COPY composer.json ./
COPY composer.lock ./
RUN composer install --no-scripts --no-autoloader
ENV COMPOSER_ALLOW_SUPERUSER 1
COPY . ./
CMD ["php", "bin/run", "app:factory"]
