# Phone Book

A Laravel Breeze phone book application for managing family contacts, relationships, and phone numbers.

## Features

- Laravel Breeze authentication with login, register, profile, and logout
- Protected contact dashboard
- Light and dark mode support with saved user preference
- Contact CRUD:
  - Add contacts
  - Edit contacts
  - Delete contacts
  - View contact phone numbers
- Summary cards for total contacts, families, and phone numbers
- Seeded demo data and seeded admin login user

## Tech Stack

- PHP 8.3
- Laravel 13
- Laravel Breeze with Blade
- MySQL / MariaDB
- Tailwind CSS
- Vite
- Alpine.js

## Database Tables

This app uses four phone book tables:

- `families`
- `relationships`
- `contacts`
- `phone_numbers`

Relationships:

- A family has many contacts
- A relationship has many contacts
- A contact belongs to one family
- A contact belongs to one relationship
- A contact has many phone numbers
- A phone number belongs to one contact

## Main Routes

Authentication routes are provided by Laravel Breeze.

Phone book routes:

```text
GET    /                        Redirects to /contacts
GET    /contacts                Contact list
GET    /contacts/create         Add contact form
POST   /contacts                Store contact
GET    /contacts/{contact}/edit Edit contact form
PUT    /contacts/{contact}      Update contact
PATCH  /contacts/{contact}      Update contact
DELETE /contacts/{contact}      Delete contact
```

## Seeded Login

```text
Email: admin@example.com
Password: admin123
```

## Seeded Phone Book Data

Family:

- Main Family

Relationships:

- Father
- Mother
- Brother
- Sister

Contacts:

- Dara
- Sophea
- Vireak
- Nita

## Setup

For full system requirements and troubleshooting, see [REQUIREMENTS.md](REQUIREMENTS.md).

Install PHP dependencies:

```bash
composer install
```

Install frontend dependencies:

```bash
npm install
```

Build frontend assets:

```bash
npm run build
```

Create and seed the database:

```bash
php artisan migrate:fresh --seed
```

Start the development server:

```bash
php artisan serve --host=0.0.0.0 --port=8000
```

Open the app:

```text
http://127.0.0.1:8000
```

## Useful Commands

Clear Laravel caches:

```bash
php artisan optimize:clear
php artisan route:clear
php artisan view:clear
```

Run tests:

```bash
php artisan test
```

Start Vite in development mode:

```bash
npm run dev
```

Build production assets:

```bash
npm run build
```

## Environment Notes

The current `.env` is configured for MySQL / MariaDB:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_app
DB_USERNAME=admin

DB_PASSWORD=admin123
```
## script
```
#!/bin/bash

set -e

echo "======================================"
echo " Laravel + Apache2 Setup for Debian"
echo "======================================"

echo ""
echo "[1/10] Checking OS..."
cat /etc/os-release || true

echo ""
echo "[2/10] Updating package repository..."
sudo apt update

echo ""
echo "[3/10] Upgrading installed packages..."
sudo apt upgrade -y

echo ""
echo "[4/10] Installing Apache2..."
sudo apt install apache2 -y

echo ""
echo "[5/10] Installing PHP and Laravel extensions..."
sudo apt install \
  php \
  php-cli \
  php-common \
  php-mysql \
  php-mbstring \
  php-xml \
  php-curl \
  php-zip \
  php-bcmath \
  libapache2-mod-php \
  -y

echo ""
echo "[6/10] Installing Composer, Git, Curl, Unzip..."
sudo apt install composer git curl unzip ca-certificates gnupg lsb-release -y

echo ""
echo "[7/10] Installing database server..."
sudo apt install default-mysql-server default-mysql-client -y

echo ""
echo "[8/10] Installing Node.js and npm..."
sudo apt install nodejs npm -y

echo ""
echo "[9/10] Starting and enabling services..."
sudo systemctl start apache2
sudo systemctl enable apache2

sudo systemctl start mariadb || sudo systemctl start mysql
sudo systemctl enable mariadb || sudo systemctl enable mysql

echo ""
echo "[10/10] Enabling Apache rewrite module..."
sudo a2enmod rewrite

echo ""
echo "Restarting Apache..."
sudo systemctl restart apache2

echo ""
echo "======================================"
echo " Version Checks"
echo "======================================"

echo ""
echo "Apache version:"
apache2 -v || true

echo ""
echo "PHP version:"
php -v || true

echo ""
echo "PHP modules:"
php -m | grep -E "PDO|pdo_mysql|mbstring|openssl|tokenizer|xml|ctype|json|curl|fileinfo|zip" || true

echo ""
echo "Composer version:"
composer --version || true

echo ""
echo "Node.js version:"
node -v || true

echo ""
echo "npm version:"
npm -v || true

echo ""
echo "Database version:"
mariadb --version || mysql --version || true

echo ""
echo "Apache loaded PHP module:"
apache2ctl -M | grep php || echo "WARNING: PHP module not detected in Apache"

echo ""
echo "Apache status:"
systemctl is-active apache2 || true

echo ""
echo "Database status:"
systemctl is-active mariadb || systemctl is-active mysql || true

echo ""
echo "======================================"
echo " Setup finished."
echo " Next manual steps:"
echo " 1. Clone phone-book project"
echo " 2. Create phone_book database"
echo " 3. Configure Laravel .env"
echo " 4. Run composer install and npm install"
echo " 5. Run migration and build assets"
echo " 6. Configure Apache virtual host"
echo "======================================"
```
Make sure the database exists and the PHP MySQL extension is installed before running migrations.
