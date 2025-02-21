#!/bin/bash

echo "🚀 Starting Task Tracker setup..."

# Check if required software is installed
echo "📋 Checking system requirements..."

if ! command -v php &> /dev/null; then
    echo "❌ PHP is not installed. Please install PHP 8.x"
    exit 1
fi

if ! command -v composer &> /dev/null; then
    echo "❌ Composer is not installed. Please install Composer"
    exit 1
fi

if ! command -v node &> /dev/null; then
    echo "❌ Node.js is not installed. Please install Node.js"
    exit 1
fi

if ! command -v npm &> /dev/null; then
    echo "❌ npm is not installed. Please install npm"
    exit 1
fi

if ! command -v sqlite3 &> /dev/null; then
    echo "❌ SQLite is not installed. Please install SQLite"
    exit 1
fi

echo "✅ All required software is installed"

# Install PHP dependencies
echo "📦 Installing PHP dependencies..."
composer install

if [ $? -ne 0 ]; then
    echo "❌ Failed to install PHP dependencies"
    exit 1
fi

# Install JavaScript dependencies
echo "📦 Installing JavaScript dependencies..."
npm install

if [ $? -ne 0 ]; then
    echo "❌ Failed to install JavaScript dependencies"
    exit 1
fi

# Set up environment file
echo "⚙️ Setting up environment..."
if [ ! -f .env ]; then
    cp .env.example .env
    php artisan key:generate
fi

# Set up database
echo "🗄️ Setting up database..."
if [ ! -f database/database.sqlite ]; then
    touch database/database.sqlite
fi

echo "🔄 Running migrations and seeding database..."
php artisan migrate:fresh --seed

if [ $? -ne 0 ]; then
    echo "❌ Failed to set up database"
    exit 1
fi

echo "✅ Setup completed successfully!"
echo ""
echo "🚀 To start the application:"
echo "1. In one terminal, run: php artisan serve"
echo "2. In another terminal, run: npm run dev"
echo "3. Visit: http://127.0.0.1:8000"
echo ""
echo "Test account:"
echo "Email: test@example.com"
echo "Password: password" 