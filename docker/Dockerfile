# syntax=docker/dockerfile:1

FROM yiisoftware/yii2-php:8.1-fpm-nginx-min AS prod

ENV PHP_IMAGE_LIB "imagick"

COPY app /app
WORKDIR /app

RUN apt update -y;
RUN apt install -y zip;

RUN install-php-extensions \
        $PHP_IMAGE_LIB

CMD ["/app/bin/in-container-entrypoint.sh", "prod"]


FROM yiisoftware/yii2-php:8.1-fpm-nginx AS dev

ENV PHP_IMAGE_LIB "imagick"

RUN mkdir -pv "/app"
WORKDIR /app

RUN apt update -y;
RUN apt install -y zip;

RUN install-php-extensions \
        $PHP_IMAGE_LIB

COPY app/composer.* /app/
COPY app/bin /app/
CMD ["/app/bin/in-container-entrypoint.sh", "dev"]
