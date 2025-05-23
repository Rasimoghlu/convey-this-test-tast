<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development/)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

# SampleName Laravel Application

This is a simple Laravel application that demonstrates user authentication, domain management, plans, and user administration.

## Features

- User Registration and Authentication
- Domain Management (Add, Edit, Delete)
- Plan Subscription
- Admin User Management

## Requirements

- PHP 8.1 or higher
- Composer
- SQLite or MySQL

## Installation

1. Clone the repository:
   ```
   git clone <repository-url>
   cd <repository-directory>
   ```

2. Install dependencies:
   ```
   composer install
   ```

3. Set up environment:
   ```
   cp .env.example .env
   ```

4. Configure your database in the `.env` file:
   ```
   # For SQLite
   DB_CONNECTION=sqlite
   DB_DATABASE=database/database.sqlite
   
   # Or for MySQL
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=samplename
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. If using SQLite, create the database file:
   ```
   touch database/database.sqlite
   ```

6. Generate application key:
   ```
   php artisan key:generate
   ```

7. Run migrations and seeders:
   ```
   php artisan migrate --seed
   ```

8. Start the development server:
   ```
   php artisan serve
   ```

9. Access the application:
   ```
   http://localhost:8000
   ```

## Default Users

After running the seeders, the following users will be available:

- Admin: admin@example.com / password
- Regular users: user1@example.com through user25@example.com / password

## Testing

The application includes a suite of unit tests built with Pest PHP framework. The tests use mocking to isolate components and eliminate database dependencies.

### Running Tests

You can run the tests using the custom Artisan command:

```bash
php artisan test:unit
```

Or run directly with Pest:

```bash
./vendor/bin/pest
```

To run specific test files:

```bash
./vendor/bin/pest --filter BasicUserTest
```

### Test Structure

The unit tests are organized as follows:

- **User Tests**: Tests for the User model and isAdmin functionality
- **Auth Service Tests**: Tests for gate definitions and admin access permissions
- **Domain Policy Tests**: Tests for authorization policies on domain operations
- **Domain Service Tests**: Tests for domain management service operations

### Testing Approach

The tests use Mockery to mock dependencies and isolate the components being tested:

- Models are mocked to avoid database interactions
- Facades like Auth are mocked to control their behavior
- Repositories are mocked to provide predictable data

This approach ensures the tests are fast, reliable, and don't depend on the state of the database.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
