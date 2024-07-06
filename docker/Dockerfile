# syntax=docker/dockerfile:1

FROM yiisoftware/yii2-php:8.1-fpm-nginx-min AS base-build

ENV PHP_IMAGE_LIB "imagick"


WORKDIR /app

RUN apt update -y;
RUN apt install -y zip;

RUN install-php-extensions \
    	$PHP_IMAGE_LIB \
        redis

RUN php -r "copy('https://getcomposer.org/installer', '/tmp/composer-setup.php');";
RUN php -r "if (hash_file('sha384', '/tmp/composer-setup.php') === 'e21205b207c3ff031906575712edab6f13eb0b361f2085f1f1237b7126d785e826a450292b6cfd1d64d92e6563bbde02') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;";
RUN php /tmp/composer-setup.php;
RUN php -r "unlink('/tmp/composer-setup.php');";

RUN mv composer.phar /bin/composer;

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
