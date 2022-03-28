#!/bin/sh

cd /var/www

composer install

php artisan key:generate
php artisan migrate

/usr/bin/supervisord -c /etc/supervisord.conf --silent
