#!/bin/bash

# Process kill of app with same ports
sudo pkill apache2
sudo pkill postgres

# Copy env variables
# APP
cp app/.env.example app/.env
echo 'DATABASE_URL="postgresql://main:main@pgsql_db:5432/main?serverVersion=13&charset=utf8"' > app/.env

# Build Docker Image
docker-compose stop
docker-compose up --build

# Setup App
docker-compose exec php_app php app/bin/console secrets:generate-keys
docker-compose exec php_app php app/bin/console doctrine:schema:create
docker-compose exec php_app php app/bin/console doctrine:migrations:migrate