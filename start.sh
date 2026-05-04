#!/bin/bash

cd /var/www/html

# Write .env file from Render environment variables
printenv | grep -E '^(APP_|DB_|SESSION_|CACHE_|QUEUE_|LOG_)' > /tmp/env_vars

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

SESSION_DRIVER=database
SESSION_LIFETIME=120
CACHE_STORE=database
QUEUE_CONNECTION=database
FILESYSTEM_DISK=local
LOG_CHANNEL=stack
LOG_LEVEL=debug
EOF

echo "--- .env written ---"
cat .env

php artisan config:clear
php artisan key:generate --force
php artisan migrate --force
php artisan db:seed --force

echo "--- migrations done ---"

apache2-foreground