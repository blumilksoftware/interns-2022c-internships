#!/bin/bash

if [ ! -f ".env" ]; then
  cp .env.example .env

  echo "Please, fill in VITE_MAPBOX_TOKEN variable in .env file."
  echo -n "Do you want to do that now? Y/n "
  read writeMapboxToken

  mapboxToken=""
  if [[ "${writeMapboxToken}" =~ ["y(?:es)?|1"] ]]; then
      echo -n "Input your public MapBox key: "
      read mapboxToken
  fi

  echo "VITE_MAPBOX_TOKEN='${mapboxToken}'" >> ".env"
fi


docker-compose build --no-cache --pull
docker-compose up -d

docker-compose exec node npm install
docker-compose exec node npm run build

docker-compose exec php composer install
docker-compose exec php php artisan key:generate
docker-compose up -d --force-recreate php
