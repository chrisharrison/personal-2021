FROM php:8.0.3-cli as builder

RUN apt-get update && apt-get upgrade -y
RUN apt-get install -y git zip unzip libzip-dev wget fontconfig libfreetype6 libjpeg62-turbo libpng16-16 libxrender1 xfonts-75dpi xfonts-base

# wkhtmltopdf
RUN wget https://github.com/wkhtmltopdf/wkhtmltopdf/releases/download/0.12.5/wkhtmltox_0.12.5-1.buster_amd64.deb
ARG DEBIAN_FRONTEND=noninteractive
RUN dpkg -i ./wkhtmltox_0.12.5-1.buster_amd64.deb

RUN mkdir -p /app
RUN adduser personal2021 --system --group -u 1000 && chown -R personal2021: /app

WORKDIR /app

COPY --from=composer:2.0 /usr/bin/composer /usr/local/bin/composer

COPY --chown=personal2021:personal2021 composer.json composer.lock ./
RUN composer install

COPY --chown=personal2021:personal2021 . ./

RUN composer dump-autoload --optimize

CMD vendor/bin/vogen && php app.php && wkhtmltopdf "file:///app/dist/cv.html" /app/dist/chris-harrison-cv.pdf