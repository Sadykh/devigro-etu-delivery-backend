#!/bin/sh

docker-compose exec php-cli sh -c "cd /var/www/; composer --prefer-dist $*"

