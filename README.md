# Eventify Backend

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Eventify

Eventify is a backend application built with PHP Laravel and Blade to manage events. The frontend is developed using Dart/Flutter, providing a seamless and interactive user experience.

### Features

- **Event Management**: Create, update, delete, and view events.
- **User Authentication**: Secure user authentication and authorization.
- **API Integration**: RESTful API endpoints for frontend communication.
- **Database Migrations**: Easy database management with Laravel migrations.

## Getting Started

### Prerequisites

- PHP >= 7.3
- Composer
- Node.js & npm
- Dart & Flutter

### Installation

1. Clone the repository:
    ```sh
    git clone https://github.com/Pablorv28/eventify-backend.git
    cd eventify-backend
    ```

2. Install PHP dependencies:
    ```sh
    composer install
    ```

3. Install Node.js dependencies:
    ```sh
    npm install
    ```

4. Copy the `.env.example` file to `.env` and configure your environment variables:
    ```sh
    cp .env.example .env
    ```

5. Generate an application key:
    ```sh
    php artisan key:generate
    ```

6. Run database migrations:
    ```sh
    php artisan migrate
    ```

7. Start the development server:
    ```sh
    php artisan serve
    ```

### Frontend Setup

1. Navigate to the frontend directory:
    ```sh
    cd path/to/flutter/frontend
    ```

2. Get Flutter dependencies:
    ```sh
    flutter pub get
    ```

3. Run the Flutter application:
    ```sh
    flutter run
    ```

## Authors

- Pablorv28
- RafBel94

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.