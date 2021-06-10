#!/bin/bash

# Init fresh project
docker-compose exec php_app composer install
docker-compose exec php_app php bin/console doctrine:schema:create
docker-compose exec php_app php bin/console make:migration
docker-compose exec php_app php bin/console doctrine:migrations:migrate