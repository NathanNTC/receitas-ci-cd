#!/bin/bash

ENVIRONMENT=$1

echo "Deploy iniciado..."

if [ "$ENVIRONMENT" = "homolog" ]; then
    cp .env.homolog .env
fi

if [ "$ENVIRONMENT" = "prod" ]; then
    cp .env.prod .env
fi

sudo docker compose down

sudo docker compose up -d --build

sleep 10

sudo docker exec receitas_app php artisan key:generate

sudo docker exec receitas_app php artisan migrate:fresh --seed

echo "Deploy finalizado."