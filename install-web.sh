#!/bin/bash
# ========================================
# Sistem Manajemen Ruangan - Installation Script
# Linux/Mac Version
# ========================================

# Exit on error for critical commands
# Some commands use || {} for non-critical failures (like build or migrate)
set -e

echo ""
echo "========================================"
echo "  Sistem Manajemen Ruangan"
echo "  Installation Script"
echo "========================================"
echo ""

# Check if .env exists
if [ ! -f .env ]; then
    echo "[1/8] Creating .env file..."
    cp .env.example .env
    echo "      .env file created successfully"
else
    echo "[1/8] .env file already exists, skipping..."
fi

echo ""
echo "[2/8] Installing Composer dependencies..."
composer install
if [ $? -ne 0 ]; then
    echo "ERROR: Composer install failed"
    echo "Please make sure Composer is installed: https://getcomposer.org"
    exit 1
fi

echo ""
echo "[3/8] Generating application key..."
php artisan key:generate
if [ $? -ne 0 ]; then
    echo "ERROR: Failed to generate application key"
    exit 1
fi

echo ""
echo "[4/8] Installing NPM dependencies..."
npm install
if [ $? -ne 0 ]; then
    echo "ERROR: NPM install failed"
    echo "Please make sure Node.js is installed: https://nodejs.org"
    exit 1
fi

echo ""
echo "[5/8] Building assets with Vite..."
npm run build || {
    echo "WARNING: Asset build failed"
    echo "The application will fallback to CDN for styles"
}

echo ""
echo "[6/8] Clearing Laravel cache..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear

echo ""
echo "[7/8] Running database migrations..."
# Note: --force flag is used for non-interactive installation
# WARNING: Only use this script in development environment!
php artisan migrate --force || {
    echo "WARNING: Migration failed"
    echo "Make sure your database is configured in .env file"
}

echo ""
echo "========================================"
echo "  Installation Complete!"
echo "========================================"
echo ""
echo "IMPORTANT: Don't forget to import the database!"
echo "  1. Import projectadm.sql to MySQL"
echo "  2. Create admin user (see README.md)"
echo ""
echo "[8/8] Starting development server..."
echo ""
echo "Access the application at: http://127.0.0.1:8000"
echo "Press Ctrl+C to stop the server"
echo ""
php artisan serve
