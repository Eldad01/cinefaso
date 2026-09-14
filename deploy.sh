#!/bin/bash

set -e

APP_DIR="/opt/cinefaso"
COMPOSE="docker compose -f docker-compose.prod.yml"

echo "=== Déploiement manuel CinéFaso ==="

cd "$APP_DIR"

echo "1. Récupération du code..."
git fetch origin main
git reset --hard origin/main

echo "2. Construction de l'image Docker..."
docker build -t eldad01/cinefaso:latest .

echo "3. Redémarrage de l'application..."
$COMPOSE up -d

echo "4. Migrations..."
$COMPOSE exec -T app php artisan migrate --force

echo "5. Recréation des caches..."
$COMPOSE exec -T app php artisan optimize:clear
$COMPOSE exec -T app php artisan config:cache
$COMPOSE exec -T app php artisan route:cache
$COMPOSE exec -T app php artisan view:cache

echo "6. Nettoyage des anciennes images..."
docker image prune -f

echo "7. État des conteneurs..."
$COMPOSE ps

echo "=== Déploiement terminé ==="
