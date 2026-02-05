# Website Monitor - Laravel 12 Project

A real-time website monitoring application built with Laravel 12 that tracks the uptime/downtime of WordPress sites and sends email notifications when incidents occur.

## Features

- Continuous monitoring of multiple WordPress sites
- Dashboard with UP/DOWN status indicators
- Email notifications for downtime incidents
- Configurable check intervals per site
- 24-hour uptime/downtime history visualization
- UI with DaisyUI components
- Real-time updates with Laravel Livewire (coming soon)

## Tech Stack

- **Backend:** Laravel 12
- **Frontend:** Blade Templates, Livewire (planned), DaisyUI + Tailwind CSS
- **Database:** MySQL/PostgreSQL/SQLite
- **Queue:** Database/Redis for background jobs
- **Scheduler:** Laravel Task Scheduler for automated checks

## Requirements

- PHP 8.2 or higher[laravel](https://laravel.com/docs/12.x/migrations)
- Composer
- Node.js & NPM
- MySQL 8.0+ / PostgreSQL 12+ / SQLite 3.8+

## Installation (Development)

## 1. Clone and Install Dependencies

```
bash# Install PHP dependencies
composer install

# Install JavaScript dependencies
npm install
```

## 2. Environment Configuration

```
bash# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

## 3. Configure Database

Edit `.env` file with your database credentials:[laravel](https://laravel.com/docs/12.x/migrations)

```
textDB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=website_monitor
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

## 4. Run Migrations and Seeders

```
bash# Create database tables
php artisan migrate

# Seed with sample data (optional)
php artisan db:seed
```

## 5. Compile Assets

```
bash# Development (watch for changes)
npm run dev

# Production build
npm run build
```

## 6. Start Development Server

```
bash# Start Laravel development server
php artisan serve

# Application will be available at http://localhost:8000
```

## 7. Run Queue Worker (Required for monitoring)

```
bash# Start queue worker for background jobs
php artisan queue:work

# Or use queue:listen for auto-reloading during development
php artisan queue:listen
```

## 8. Run Scheduler (Required for automated checks)

For development, run the scheduler manually:[laravel](https://laravel.com/docs/12.x/migrations)

```
bash
php artisan schedule:work
```

## Production Deployment

## 1. Configure Queue Worker

Set up Supervisor to keep queue workers running:[laravel](https://laravel.com/docs/12.x/migrations)

```
text[program:website-monitor-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /path/to/your/project/artisan queue:work --sleep=3 --tries=3 --max-time=3600
autostart=true
autorestart=true
stopasgroup=true
killasgroup=true
user=www-data
numprocs=2
redirect_stderr=true
stdout_logfile=/path/to/your/project/storage/logs/worker.log
stopwaitsecs=3600
```

## 2. Configure Cron Job

Add to your crontab for Laravel Scheduler:[laravel](https://laravel.com/docs/12.x/migrations)

```
bash
* * * * * cd /path/to/your/project && php artisan schedule:run >> /dev/null 2>&1
```

## 3. Set Permissions

```
bash# Set proper storage permissions
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

## Development

```
bash# Start all services (requires Laravel Herd or similar)
composer dev

# Clear all caches
php artisan optimize:clear

# Reset database
php artisan migrate:fresh --seed

# Run tests
php artisan test
```

## Asset Management

```
bash# Watch for frontend changes
npm run dev

# Build for production
npm run build

# Format code
npm run format
```

## Queue & Scheduler

```
bash# Start queue worker
php artisan queue:work

# Run scheduler once (testing)
php artisan schedule:run

# Start scheduler daemon (development)
php artisan schedule:work
```

## Database

```
bash# Run migrations
php artisan migrate

# Rollback last migration
php artisan migrate:rollback

# Fresh migration with seeds
php artisan migrate:fresh --seed

# Check migration status
php artisan migrate:status
```

## Project Structure

```
textapp/
├── Http/Controllers/     # Request handlers
├── Models/              # Eloquent models
├── Http/Requests/       # Form validation
└── Console/Commands/    # Custom artisan commands

resources/
├── views/
│   ├── layouts/        # Blade layouts
│   └── admin/sites/    # Site management views
├── css/                # Stylesheets
└── js/                 # JavaScript

database/
├── migrations/         # Database schema
├── factories/          # Model factories
└── seeders/           # Database seeders

routes/
├── web.php            # Web routes
└── api.php            # API routes
```

## Configuration

## Email Notifications

Configure mail settings in `.env`:[laravel](https://laravel.com/docs/12.x/notifications)

```
textMAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=monitor@example.com
MAIL_FROM_NAME="${APP_NAME}"
```

## Troubleshooting

## Assets not loading

```
bashnpm run build
php artisan optimize:clear
```

## Queue jobs not processing

```
bash# Check queue worker is running
php artisan queue:work

# Check failed jobs
php artisan queue:failed
```

## Scheduler not running

```
bash# Verify cron is configured
crontab -l

# Test scheduler manually
php artisan schedule:run
```

------

**Status:** Active Development - Learning Project
