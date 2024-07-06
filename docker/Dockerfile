# syntax=docker/dockerfile:1

FROM yiisoftware/yii2-php:8.1-fpm-nginx-min AS base-build

ENV PHP_IMAGE_LIB "imagick"


WORKDIR /app

RUN apt update -y;
RUN apt install -y zip;

RUN install-php-extensions \
    	$PHP_IMAGE_LIB \
        redis

CMD ["/app/bin/in-container-entrypoint.sh"]


FROM base-build AS prod
COPY app /app
COPY docker/base/confs/php-fpm-app.conf /usr/local/etc/php-fpm.d/php-fpm-app.conf

RUN echo "prod" > /opt/docker-stage.txt


FROM base-build AS demo

COPY app /app
COPY docker/base/confs/php-fpm-app.conf /usr/local/etc/php-fpm.d/php-fpm-app.conf

RUN echo "demo" > /opt/docker-stage.txt


FROM base-build AS dev

RUN mkdir -pv "/app"

COPY app/composer.* /app/
COPY app/bin /app/

RUN echo "dev" > /opt/docker-stage.txt
