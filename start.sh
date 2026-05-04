#!/bin/bash

set -e

cd /var/www/html

echo "==> Clearing config cache..."
php artisan config:clear

echo "==> Writing .env from environment variables..."
cat > .env << EOF
APP_NAME=ASEIS
APP_ENV=${APP_ENV:-production}
APP_KEY=${APP_KEY}
APP_DEBUG=${APP_DEBUG:-false}
APP_URL=${APP_URL:-http://localhost}

LOG_CHANNEL=stack
LOG_LEVEL=debug

DB_CONNECTION=${DB_CONNECTION:-mysql}
DB_HOST=${DB_HOST}
DB_PORT=${DB_PORT:-3306}
DB_DATABASE=${DB_DATABASE}
DB_USERNAME=${DB_USERNAME}
DB_PASSWORD=${DB_PASSWORD}

SESSION_DRIVER=${SESSION_DRIVER:-database}
SESSION_LIFETIME=120
CACHE_STORE=${CACHE_STORE:-database}
QUEUE_CONNECTION=${QUEUE_CONNECTION:-database}

FILESYSTEM_DISK=local
EOF

echo "==> Generating app key if missing..."
php artisan key:generate --no-interaction --force

echo "==> Caching config..."
php artisan config:cache

echo "==> Running migrations..."
php artisan migrate --force --no-interaction

echo "==> Running seeders..."
php artisan db:seed --force --no-interaction

echo "==> Starting Apache..."
apache2-foreground