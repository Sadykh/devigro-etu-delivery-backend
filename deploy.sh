#!/bin/sh

docker-compose up -d
./composer.sh install
docker-compose exec php-cli chown -R www-data:www-data /var/www/var
sleep 30

./db_migration.sh
php bin/console.php app:init

