#!/bin/bash

set -e

echo "Starting Laravel application..."

# Wait for MySQL port to be open
echo "Waiting for MySQL to be ready..."
MAX_TRIES=30
COUNT=0

until [ $COUNT -ge $MAX_TRIES ]; do
    if nc -z "${DB_HOST}" "${DB_PORT}"; then
        echo "MySQL port is open!"
        break
    fi
    echo "MySQL port is not open yet - sleeping (attempt $COUNT/$MAX_TRIES)"
    COUNT=$((COUNT+1))
    sleep 2
done

if [ $COUNT -ge $MAX_TRIES ]; then
    echo "Failed to connect to MySQL port after $MAX_TRIES attempts"
    exit 1
fi

# Give MySQL a moment to fully initialize
sleep 3
echo "MySQL is ready!"

# Run Laravel setup commands
echo "Running Laravel optimizations..."

# Cache configuration
php artisan config:cache

# Cache routes
php artisan route:cache

# Skip view:cache as it may fail with old/unused blade files
# php artisan view:cache

# Run migrations (only if AUTO_MIGRATE is set to true)
if [ "${AUTO_MIGRATE}" = "true" ]; then
    echo "Running database migrations..."
    php artisan migrate --force
fi

# Create storage link if it doesn't exist
if [ ! -L /var/www/html/public/storage ]; then
    echo "Creating storage link..."
    php artisan storage:link
fi

# Set proper permissions
echo "Setting permissions..."
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

echo "Laravel application is ready!"

# Execute CMD
exec "$@"
