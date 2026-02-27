#!/bin/bash

# Colors for output
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
NC='\033[0m' # No Color

echo -e "${GREEN}============================================${NC}"
echo -e "${GREEN}  DesciCrypto Docker Setup${NC}"
echo -e "${GREEN}============================================${NC}\n"

# Check if Docker is installed
if ! command -v docker &> /dev/null; then
    echo -e "${RED}Error: Docker is not installed${NC}"
    echo "Please install Docker first: https://docs.docker.com/get-docker/"
    exit 1
fi

# Check if Docker Compose is installed
if ! command -v docker-compose &> /dev/null; then
    echo -e "${RED}Error: Docker Compose is not installed${NC}"
    echo "Please install Docker Compose first: https://docs.docker.com/compose/install/"
    exit 1
fi

# Check if .env file exists
if [ ! -f .env ]; then
    echo -e "${RED}Error: .env file not found${NC}"
    echo "Please create .env file first"
    exit 1
fi

echo -e "${YELLOW}Step 1: Checking environment...${NC}"

# Update .env for Docker if needed
if grep -q "DB_HOST=127.0.0.1" .env; then
    echo -e "${YELLOW}Updating DB_HOST to 'mysql' for Docker...${NC}"
    sed -i.bak 's/DB_HOST=127.0.0.1/DB_HOST=mysql/' .env
fi

if grep -q "REDIS_HOST=127.0.0.1" .env; then
    echo -e "${YELLOW}Updating REDIS_HOST to 'redis' for Docker...${NC}"
    sed -i.bak 's/REDIS_HOST=127.0.0.1/REDIS_HOST=redis/' .env
fi

# Set DB_PASSWORD if empty
if grep -q "DB_PASSWORD=$" .env; then
    echo -e "${YELLOW}Setting default database password...${NC}"
    sed -i.bak 's/DB_PASSWORD=$/DB_PASSWORD=secret/' .env
fi

echo -e "${GREEN}✓ Environment configured${NC}\n"

echo -e "${YELLOW}Step 2: Building Docker images...${NC}"
echo "This may take a few minutes on first run..."
docker-compose build

if [ $? -ne 0 ]; then
    echo -e "${RED}Error: Docker build failed${NC}"
    exit 1
fi

echo -e "${GREEN}✓ Docker images built successfully${NC}\n"

echo -e "${YELLOW}Step 3: Starting containers...${NC}"
docker-compose up -d

if [ $? -ne 0 ]; then
    echo -e "${RED}Error: Failed to start containers${NC}"
    exit 1
fi

echo -e "${GREEN}✓ Containers started${NC}\n"

echo -e "${YELLOW}Step 4: Waiting for services to be ready...${NC}"
sleep 5

# Wait for MySQL to be ready
echo "Waiting for MySQL..."
for i in {1..30}; do
    if docker-compose exec -T mysql mysqladmin ping -h localhost --silent 2>/dev/null; then
        echo -e "${GREEN}✓ MySQL is ready${NC}"
        break
    fi
    echo -n "."
    sleep 2
done

echo ""

echo -e "${YELLOW}Step 5: Running migrations...${NC}"
docker-compose exec -T app php artisan migrate --force

if [ $? -ne 0 ]; then
    echo -e "${YELLOW}Warning: Migrations failed or already run${NC}"
fi

echo -e "${GREEN}✓ Application setup complete!${NC}\n"

echo -e "${GREEN}============================================${NC}"
echo -e "${GREEN}  Application is now running!${NC}"
echo -e "${GREEN}============================================${NC}\n"

echo -e "🌐 Application URL: ${GREEN}http://localhost:8000${NC}"
echo -e "🗄️  MySQL Port:     ${GREEN}localhost:3307${NC}"
echo -e "💾 Redis Port:     ${GREEN}localhost:6380${NC}\n"

echo -e "${YELLOW}Useful commands:${NC}"
echo "  View logs:          docker-compose logs -f"
echo "  Stop containers:    docker-compose stop"
echo "  Restart:            docker-compose restart"
echo "  Shell access:       docker-compose exec app sh"
echo "  Run artisan:        docker-compose exec app php artisan [command]"
echo ""

echo -e "${GREEN}For more information, check DOCKER.md${NC}\n"
