#!/bin/bash

# Exit on error
set -e

echo "🚀 Starting Deployment..."

# 1. Pull latest changes (optional, usually done by CI/CD or Manual)
# git pull origin main

# 2. Install/Update PHP dependencies
echo "📦 Installing PHP dependencies..."
composer install --no-dev --optimize-autoloader

# 3. Handle Environment & Key
if [ ! -f .env ]; then
    echo "📄 Creating .env file..."
    cp .env.example .env
    php artisan key:generate
fi

# 4. Install/Update Node dependencies
echo "📦 Installing Node dependencies..."
npm install

# 5. Build frontend assets
echo "🏗️ Building frontend assets..."
# Remove the hot-reload file if it exists to prevent Vite dev server mismatch
rm -f public/hot
npm run build

# 6. Run database migrations
echo "🗄️ Running database migrations..."
php artisan migrate --force

# 7. Clear and Cache Config/Routes/Views
echo "🧹 Clearing and Caching..."
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 8. Set Permissions
echo "🔐 Setting permissions..."
chmod -R 775 storage bootstrap/cache

# chown -R www-data:www-data .

echo "✅ Deployment Complete!"
