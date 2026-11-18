# Laravel POS — TFA7

**Author:** Marixine Sofia S. Manahan  
**Course:** IT0049 — Web System Technologies

## Features

- Customer listing, creation, and editing
- User account listing, creation, and editing
- Required field and email validation
- Unique customer email and user username validation
- Validation errors with preserved text input
- Optional user avatar uploads on the edit page
- JPG/PNG validation with a 2 MB limit
- 256 × 256 PNG thumbnail preparation
- Generated filenames and public disk storage
- Placeholder avatar when no image is uploaded

## Requirements

- PHP 8.2 or compatible newer version
- Composer
- MySQL
- PHP GD extension

## Installation

Clone the repository, enter the project folder, and run:

```bash
composer install
```

Copy `.env.example` to `.env`.

Create a MySQL database and configure the DB settings in `.env`.

Then run:

```bash
php artisan key:generate
php artisan config:clear
php artisan migrate --seed
php artisan storage:link
php artisan serve
```

Open http://127.0.0.1:8000.

## Main Routes

- /
- /customers
- /customers/create
- /users
- /users/create

Use Edit in either listing to update an existing record.

## Database

The database structure and fictional sample records are supplied
through migrations and DatabaseSeeder.

The customer table uses full_name.
The user form maps full_name to Laravel's existing name column.

## Avatar Handling

Intervention Image v3 prepares 256 × 256 PNG thumbnails.

Files are stored on the public disk under avatars/.
Only the relative path is stored in the users.avatar column.

Replacing an avatar removes the old file after the record is updated.

## Scope

This is a classroom CRUD demonstration.
Authentication and admin authorization are not implemented.

## Hosted Application

Add the actual working hosted application URL here before submission.