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

Make sure the database exists and the PHP MySQL extension is installed before running migrations.
