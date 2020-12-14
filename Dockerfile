FROM php:fpm-alpine
WORKDIR /app
COPY . /app/
ENTRYPOINT [ "php","/app/demo.php"]