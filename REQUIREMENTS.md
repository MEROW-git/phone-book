# Requirements

This file lists what another user needs to install and configure before running the Phone Book project.

## System Requirements

- PHP 8.3 or newer
- Composer
- Node.js 20 or newer
- npm
- MySQL or MariaDB

## Required PHP Extensions

The project needs these PHP extensions:

- `pdo`
- `pdo_mysql`
- `mbstring`
- `openssl`
- `tokenizer`
- `xml`
- `ctype`
- `json`
- `curl`
- `fileinfo`
- `zip`

On Ubuntu, install the common required packages with:

```bash
sudo apt-get update
sudo apt-get install -y php8.3 php8.3-cli php8.3-mysql php8.3-mbstring php8.3-xml php8.3-curl php8.3-zip unzip composer nodejs npm mysql-server
```

## Database Setup

Create a MySQL/MariaDB database that matches `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_app
DB_USERNAME=admin
DB_PASSWORD=admin123
```

Example MySQL setup:

```sql
CREATE DATABASE laravel_app;
CREATE USER 'admin'@'localhost' IDENTIFIED BY 'admin123';
GRANT ALL PRIVILEGES ON laravel_app.* TO 'admin'@'localhost';
FLUSH PRIVILEGES;
```

## Project Installation

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

Generate the app key if needed:

```bash
php artisan key:generate
```

Run migrations and seeders:

```bash
php artisan migrate:fresh --seed
```

Start the server:

```bash
php artisan serve --host=0.0.0.0 --port=8000
```

Open:

```text
http://127.0.0.1:8000
```

## Default Login

```text
Email: admin@example.com
Password: admin123
```

## Quick Verification

Check PHP:

```bash
php -v
php -m
```

Check Composer:

```bash
composer --version
```

Check Node and npm:

```bash
node --version
npm --version
```

Check Laravel routes:

```bash
php artisan route:list
```

## Common Issues

If you see `could not find driver`, install the MySQL PHP extension:

```bash
sudo apt-get install -y php8.3-mysql
```

If you see `vite: not found`, install frontend dependencies:

```bash
npm install
```

If you see `Vite manifest not found`, build frontend assets:

```bash
npm run build
```

If old views or routes are still showing, clear Laravel caches:

```bash
php artisan optimize:clear
php artisan route:clear
php artisan view:clear
```
