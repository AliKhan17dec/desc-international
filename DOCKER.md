# Docker Deployment Guide

This guide will help you deploy the DesciCrypto Laravel application using Docker containers.

## Prerequisites

- Docker Engine (20.10+)
- Docker Compose (2.0+)
- Git

## Project Structure

```
docker/
├── nginx/
│   ├── nginx.conf          # Main Nginx configuration
│   └── default.conf        # Laravel-specific server configuration
├── supervisor/
│   └── supervisord.conf    # Supervisor config for PHP-FPM, Nginx, and Queue workers
└── docker-entrypoint.sh    # Initialization script
```

## Container Architecture

The application runs on **3 containers**:

1. **app** - PHP 8.2 + Nginx + Laravel application
2. **mysql** - MySQL 8.0 database
3. **redis** - Redis 7 for caching, sessions, and queues

## Local Development Setup

### 1. Configure Environment

Make sure your `.env` file has the correct database settings:

```env
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=desci-crypto
DB_USERNAME=root
DB_PASSWORD=secret

REDIS_HOST=redis
REDIS_PORT=6379
```

### 2. Build and Start Containers

```bash
# Build the Docker images
docker-compose build

# Start all containers
docker-compose up -d

# View logs
docker-compose logs -f
```

### 3. Initialize Application

The entrypoint script automatically handles:
- Waiting for MySQL to be ready
- Running Laravel optimizations (config, route, view caching)
- Creating storage symlink
- Setting proper permissions

To run migrations manually:
```bash
docker-compose exec app php artisan migrate
```

To seed the database:
```bash
docker-compose exec app php artisan db:seed
```

### 4. Access the Application

- **Application**: http://localhost:8000
- **MySQL**: localhost:3307 (from host machine)
- **Redis**: localhost:6380 (from host machine)

### 5. Useful Commands

```bash
# Stop containers
docker-compose stop

# Start containers
docker-compose start

# Restart containers
docker-compose restart

# Stop and remove containers
docker-compose down

# Stop and remove containers + volumes (WARNING: deletes database)
docker-compose down -v

# View container logs
docker-compose logs -f app

# Execute artisan commands
docker-compose exec app php artisan [command]

# Access container shell
docker-compose exec app sh

# Access MySQL CLI
docker-compose exec mysql mysql -uroot -psecret desci-crypto

# Clear Laravel cache
docker-compose exec app php artisan cache:clear
docker-compose exec app php artisan config:clear
docker-compose exec app php artisan route:clear
docker-compose exec app php artisan view:clear
```

## Production Deployment

### 1. Prepare Environment

Update your `.env` file for production:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_PASSWORD=your-strong-password
```

### 2. Deploy with Production Compose File

```bash
# Build and start with production configuration
docker-compose -f docker-compose.prod.yml build

# Start containers
docker-compose -f docker-compose.prod.yml up -d

# View logs
docker-compose -f docker-compose.prod.yml logs -f
```

### 3. SSL/HTTPS Setup

For production, you should use a reverse proxy like Nginx or Traefik with Let's Encrypt. Here's a quick Nginx reverse proxy setup:

**Option A: Use Nginx Reverse Proxy (Recommended)**

Create a new `nginx-proxy` service or configure your server's Nginx:

```nginx
server {
    listen 80;
    server_name yourdomain.com;
    return 301 https://$server_name$request_uri;
}

server {
    listen 443 ssl http2;
    server_name yourdomain.com;

    ssl_certificate /etc/ssl/certs/your-cert.pem;
    ssl_certificate_key /etc/ssl/private/your-key.pem;

    location / {
        proxy_pass http://localhost:80;
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto $scheme;
    }
}
```

**Option B: Use Certbot for Let's Encrypt**

```bash
# Install certbot
apt-get update && apt-get install certbot python3-certbot-nginx

# Get SSL certificate
certbot --nginx -d yourdomain.com
```

### 4. Database Backups

**Automated backup script:**

```bash
#!/bin/bash
# backup.sh

BACKUP_DIR="/backups/mysql"
TIMESTAMP=$(date +%Y%m%d_%H%M%S)
CONTAINER_NAME="desci-mysql-prod"
DB_NAME="desci-crypto"
DB_USER="root"
DB_PASSWORD="your-password"

mkdir -p $BACKUP_DIR

docker exec $CONTAINER_NAME mysqldump -u$DB_USER -p$DB_PASSWORD $DB_NAME > $BACKUP_DIR/backup_$TIMESTAMP.sql

# Keep only last 7 days of backups
find $BACKUP_DIR -name "backup_*.sql" -mtime +7 -delete

echo "Backup completed: backup_$TIMESTAMP.sql"
```

Set up a cron job:
```bash
0 2 * * * /path/to/backup.sh
```

## Troubleshooting

### Issue: Permission denied errors

```bash
docker-compose exec app chown -R www-data:www-data /var/www/html/storage
docker-compose exec app chmod -R 775 /var/www/html/storage
```

### Issue: MySQL connection refused

Check if MySQL is ready:
```bash
docker-compose exec mysql mysqladmin ping -h localhost
```

### Issue: 500 Server Error

Check logs:
```bash
docker-compose logs app
docker-compose exec app tail -f storage/logs/laravel.log
```

Clear cache:
```bash
docker-compose exec app php artisan config:clear
docker-compose exec app php artisan cache:clear
```

### Issue: Assets not loading

Rebuild the image:
```bash
docker-compose down
docker-compose build --no-cache
docker-compose up -d
```

### Issue: Queue jobs not processing

Check supervisor status:
```bash
docker-compose exec app supervisorctl status
docker-compose exec app supervisorctl restart laravel-queue:*
```

## Monitoring

### Health Checks

All services include health checks. Check status:
```bash
docker-compose ps
```

### Resource Usage

```bash
docker stats
```

### Container Logs

```bash
# All containers
docker-compose logs -f

# Specific container
docker-compose logs -f app
docker-compose logs -f mysql
docker-compose logs -f redis
```

## Scaling

To scale queue workers:

Update `supervisord.conf`:
```ini
[program:laravel-queue]
numprocs=4  # Increase number of workers
```

Rebuild:
```bash
docker-compose build app
docker-compose up -d
```

## Maintenance Mode

```bash
# Enable maintenance mode
docker-compose exec app php artisan down

# Disable maintenance mode
docker-compose exec app php artisan up
```

## Updates and Redeployment

```bash
# Pull latest code
git pull origin main

# Rebuild and restart
docker-compose down
docker-compose build --no-cache
docker-compose up -d

# Run migrations
docker-compose exec app php artisan migrate --force
```

## Security Best Practices

1. **Change default passwords** in `.env`
2. **Use strong DB_PASSWORD** for production
3. **Set APP_DEBUG=false** in production
4. **Keep Docker images updated**:
   ```bash
   docker-compose pull
   docker-compose up -d
   ```
5. **Implement rate limiting** in Laravel
6. **Use firewall** to restrict database port access
7. **Regular backups** of database and storage
8. **Monitor logs** for suspicious activity

## Support

For issues or questions, check:
- Application logs: `storage/logs/laravel.log`
- Nginx logs: `docker-compose logs nginx`
- PHP-FPM logs: `docker-compose logs app`
