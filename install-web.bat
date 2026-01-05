@echo off
REM ========================================
REM Sistem Manajemen Ruangan - Installation Script
REM Windows Version
REM ========================================

echo.
echo ========================================
echo   Sistem Manajemen Ruangan
echo   Installation Script
echo ========================================
echo.

REM Check if .env exists
if not exist .env (
    echo [1/8] Creating .env file...
    copy .env.example .env >nul
    if errorlevel 1 (
        echo ERROR: Failed to create .env file
        pause
        exit /b 1
    )
    echo       .env file created successfully
) else (
    echo [1/8] .env file already exists, skipping...
)

echo.
echo [2/8] Installing Composer dependencies...
call composer install
if errorlevel 1 (
    echo ERROR: Composer install failed
    echo Please make sure Composer is installed: https://getcomposer.org
    pause
    exit /b 1
)

echo.
echo [3/8] Generating application key...
php artisan key:generate
if errorlevel 1 (
    echo ERROR: Failed to generate application key
    pause
    exit /b 1
)

echo.
echo [4/8] Installing NPM dependencies...
call npm install
if errorlevel 1 (
    echo ERROR: NPM install failed
    echo Please make sure Node.js is installed: https://nodejs.org
    pause
    exit /b 1
)

echo.
echo [5/8] Building assets with Vite...
call npm run build
if errorlevel 1 (
    echo WARNING: Asset build failed
    echo The application will fallback to CDN for styles
)

echo.
echo [6/8] Clearing Laravel cache...
php artisan config:clear
php artisan cache:clear
php artisan view:clear

echo.
echo [7/8] Running database migrations...
REM Note: --force flag is used for non-interactive installation
REM WARNING: Only use this script in development environment!
php artisan migrate --force
if errorlevel 1 (
    echo WARNING: Migration failed
    echo Make sure your database is configured in .env file
)

echo.
echo ========================================
echo   Installation Complete!
echo ========================================
echo.
echo IMPORTANT: Don't forget to import the database!
echo   1. Import projectadm.sql to MySQL
echo   2. Create admin user (see README.md)
echo.
echo [8/8] Starting development server...
echo.
echo Access the application at: http://127.0.0.1:8000
echo Press Ctrl+C to stop the server
echo.
php artisan serve
