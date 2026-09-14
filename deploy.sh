#!/bin/bash

set -e

APP_DIR="/opt/cinefaso"
COMPOSE="docker compose -f docker-compose.prod.yml"

echo "=== Déploiement CinéFaso ==="

cd "$APP_DIR"

echo "1. Récupération du code..."
git fetch origin main
git reset --hard origin/main

echo "2. Construction et démarrage des conteneurs..."
$COMPOSE up -d --build

echo "3. Migrations..."
$COMPOSE exec -T app php artisan migrate --force

echo "4. Recréation des caches..."
$COMPOSE exec -T app php artisan optimize:clear
$COMPOSE exec -T app php artisan config:cache
$COMPOSE exec -T app php artisan route:cache
$COMPOSE exec -T app php artisan view:cache

echo "5. Nettoyage des anciennes images..."
docker image prune -f

echo "6. État des conteneurs..."
$COMPOSE ps

echo "=== Déploiement terminé ==="
