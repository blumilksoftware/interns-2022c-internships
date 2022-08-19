#!/bin/bash

if [ ! -f ".env" ]; then
  cp .env.example .env
fi

docker-compose build --no-cache --pull
docker-compose up -d

docker-compose exec node npm install
docker-compose exec node npm run build

docker-compose exec php composer install
docker-compose exec php php artisan key:generate

echo "After setting variables in .env file, remember to restart containers."
