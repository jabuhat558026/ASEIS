#!/bin/bash

cd /var/www/html

cat > .env <<EOF
APP_NAME=ASEIS
APP_ENV=production
APP_KEY=${APP_KEY}
APP_DEBUG=false
APP_URL=${APP_URL}

DB_CONNECTION=mysql
DB_HOST=${DB_HOST}
DB_PORT=${DB_PORT}
DB_DATABASE=${DB_DATABASE}
DB_USERNAME=${DB_USERNAME}
DB_PASSWORD=${DB_PASSWORD}

SESSION_DRIVER=file
SESSION_LIFETIME=120
CACHE_STORE=file
QUEUE_CONNECTION=sync
FILESYSTEM_DISK=local
LOG_CHANNEL=stack
LOG_LEVEL=debug
EOF

echo "--- .env written ---"
php artisan config:clear
php artisan config:cache
php artisan migrate --force
php artisan db:seed --force
echo "--- done ---"

apache2-foreground