#!/bin/sh

if [ ! -f ".env" ]; then
  cp .env.example .env
fi

docker-compose build --no-cache --pull
docker-compose up -d

docker-compose run --rm -u "$(id -u):$(id -g)" php composer install
docker-compose run --rm -u "$(id -u):$(id -g)" php php artisan key:generate
docker-compose run --rm -u "$(id -u):$(id -g)" php php artisan storage:link

docker-compose run --rm -u "$(id -u):$(id -g)" node npm install
docker-compose run --rm -u "$(id -u):$(id -g)" node npm run build

echo "After setting variables in .env file, remember to restart containers."
