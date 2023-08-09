#!/bin/sh

_STAGE="${1}";

cd /app || (printf "?? App folder is missing. Exiting.\n" && exit 1);

printf "## Updating Composer (%s)\n" "${_STAGE}";

if [ "${_STAGE}" = "dev" ]
then
	composer install;
else

	php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');";
    php -r "if (hash_file('sha384', 'composer-setup.php') === 'e21205b207c3ff031906575712edab6f13eb0b361f2085f1f1237b7126d785e826a450292b6cfd1d64d92e6563bbde02') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;";
    php composer-setup.php;
    php -r "unlink('composer-setup.php');";

    mv composer.phar /bin/composer;

	composer install;
fi;

printf "## Start App Container\n";

supervisord -c "/etc/supervisor/supervisord.conf";

