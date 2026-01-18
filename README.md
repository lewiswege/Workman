<p align="center"><img src="public/images/workman-logo.svg" width="400" alt="Workman Logo"></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Workman

Workman is a comprehensive installation management system designed for ISP-level operations. The application streamlines task management by organizing work assignments for teams, whether they're field crews in vehicles or office-based personnel.

## Features

- **Installation Management** - Track and manage installations with detailed records
- **Team Organization** - Coordinate teams and assign tasks efficiently
- **Phone Number Validation** - Automatic formatting and validation with regex-based whitespace removal
- **Input Masking** - Ensure data consistency with smart input masks for number fields
- **Modern UI** - Built with Filament for an intuitive, responsive interface
- **Required Fields** - Enforced data validation for critical information

## Tech Stack

- **Laravel** - Powerful PHP framework for robust backend operations
- **Filament** - Modern admin panel and form builder
- **MySQL** - Reliable database management
- Built following security best practices

## Getting Started

1. Clone the repository
2. Install dependencies:
   ```bash
   composer install
   npm install
   ```
3. Set up your environment:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
4. Configure your database in `.env`
5. Run migrations:
   ```bash
   php artisan migrate
   ```
6. Start the development server:
   ```bash
   php artisan serve
   ```

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## Security Vulnerabilities

If you discover a security vulnerability within Workman, please send an e-mail to the development team. All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
