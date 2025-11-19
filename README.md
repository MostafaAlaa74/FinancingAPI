<p align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="280" alt="Laravel Logo">
</p>

# Financing & Task Management API

An API-first Laravel 11 application that lets authenticated users track personal expenses and manage tasks in one place. It exposes REST endpoints secured with Sanctum tokens, applies per-user authorization policies, and sends onboarding emails via queued jobs.

## Features

- User registration/login/logout with Laravel Sanctum
- Task CRUD with status/priority filters and status transition helpers
- Expense tracking scoped to each user
- Queue-powered welcome email and notification logging
- Database factories + seeders for sample data

## Requirements

- PHP 8.2+
- Composer
- Node 20+ (only if recompiling front-end assets)
- SQLite (default) or any Laravel-supported database

## Getting Started

```bash
cp .env.example .env
composer install
php artisan key:generate
php artisan migrate --seed
```

Set database, mail, and queue credentials in `.env`.

### Run the API

```bash
php artisan serve
```

### Queue Worker for Welcome Emails

Registration dispatches `SendWelcomeMail` to the `emails` queue. Start a worker so messages go out:

```bash
php artisan queue:work --queue=emails
```

## Authentication

- `POST /api/register`: creates user, logs them in, dispatches welcome-email job
- `POST /api/login`: issues a Sanctum token (`Authorization: Bearer <token>`)
- `POST /api/logout`: revokes the current token

Use the returned token for any `/api/tasks/*` or `/api/expenses/*` call.

## Task Endpoints

| Method | Endpoint | Notes |
| ------ | -------- | ----- |
| GET | `/api/tasks` | List authenticated user’s tasks |
| POST | `/api/tasks` | Create task (`title`, `status`, `priority`) |
| GET | `/api/tasks/{task}` | View single task (policy enforced) |
| PUT/PATCH | `/api/tasks/{task}` | Update |
| DELETE | `/api/tasks/{task}` | Delete |
| POST | `/api/tasks/{task}/mark_completed` | Shortcut to set status |
| POST | `/api/tasks/{task}/mark_inprogress` | Shortcut to set status |
| GET | `/api/tasks/status/{status}` | Filter by `pending`, `in_progress`, `completed` |
| GET | `/api/tasks/priority/{priority}` | Filter by `low`, `medium`, `high` |

## Expense Endpoints

| Method | Endpoint | Notes |
| ------ | -------- | ----- |
| GET | `/api/expenses` | List authenticated user’s expenses |
| POST | `/api/expenses` | Create (`title`, `amount`, `expense_date`) |
| GET | `/api/expenses/{expenses}` | View |
| PUT/PATCH | `/api/expenses/{expenses}` | Update |
| DELETE | `/api/expenses/{expenses}` | Delete |

Policies ensure users can only read/write their own data.

## Testing

Run the full suite:

```bash
php artisan test
```

Add feature tests around auth, tasks, and expenses to cover future changes.

## Deployment Notes

- Serve over HTTPS and enable rate limiting when exposing publicly
- Configure queue workers + supervisors for the `emails` queue
- Monitor `storage/logs/laravel.log` for mail/job failures

## License

MIT License. See `composer.json` for details.
