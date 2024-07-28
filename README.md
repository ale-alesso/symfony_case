# Symfony Test Case

## Description

This is a sample Symfony application that includes work with three modules: users, orders and products. The application allows you to manage users, their orders and products, and send notifications via email. Orders and sending notifications are processed in queues.

## Installation

1. Install dependencies:
```bash
composer install
```

2. Set up the `.env` file to connect to the database:
```dotenv
DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name"

MAILER_FROM="noreply@example.com"
```

3. Run migrations to create tables in the database:
```bash
php bin/console doctrine:migrations:migrate
```

4. Start the built-in Symfony server:
```bash
symfony server:start
```

## Usage

### Run workers
```bash
php bin/console messenger:consume async -vv
```

### Testing
```bash
php bin/phpunit
```

## Develop

### Swagger config
See `openapi.yaml` to externally interact with API
