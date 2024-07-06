#!/bin/sh

cd /app || (printf "?? App folder is missing. Exiting.\n" && exit 1);

printf "## Updating Composer (%s)\n" "${APP_STAGE}";

if [ "${APP_STAGE}" = "dev" ]
then
	composer install;
fi;


printf "## Start App Container\n";

chmod -Rf a+rw /app/web/assets /app/runtime;

supervisord -c "/etc/supervisor/supervisord.conf";

