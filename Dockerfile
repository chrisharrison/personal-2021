FROM php:8.0.3-cli as builder

RUN apt-get update && apt-get upgrade -y
RUN apt-get install -y git zip unzip libzip-dev wget wkhtmltopdf

RUN mkdir -p /app
RUN adduser personal2021 --system --group -u 1000 && chown -R personal2021: /app

WORKDIR /app

COPY --from=composer:2.0 /usr/bin/composer /usr/local/bin/composer

COPY --chown=personal2021:personal2021 composer.json ./
RUN composer install --prefer-dist --no-scripts --no-autoloader && rm -rf /root/.composer

COPY --chown=personal2021:personal2021 . ./

CMD vendor/bin/vogen && php app.php