#!/bin/bash

# Exécuté sur le VPS par le pipeline GitHub Actions après le build+push
# de l'image sur Docker Hub. Ne construit rien — tire l'image déjà prête.

set -e

APP_DIR="/opt/cinefaso"
COMPOSE="docker compose -f docker-compose.prod.yml"

echo "=== Déploiement CinéFaso (image Docker Hub) ==="

cd "$APP_DIR"

echo "1. Téléchargement de la nouvelle image..."
docker pull eldad01/cinefaso:latest

echo "2. Redémarrage de l'application..."
$COMPOSE up -d

echo "3. Migrations..."
$COMPOSE exec -T app php artisan migrate --force

echo "4. Lien de stockage public..."
$COMPOSE exec -T app php artisan storage:link --force

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
