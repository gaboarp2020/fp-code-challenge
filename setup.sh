#!/bin/bash

# Process kill of app with same ports
sudo pkill apache2
sudo pkill postgres

# Build Docker Image
docker-compose down
docker-compose up --build