
# Introduction
This project is a web application built using the Laravel framework. It provides a robust backend for managing various functionalities, including user authentication, data management, and PDF generation using DOMPDF.

# Organization
The project is organized into several directories and files, each serving a specific purpose:

- `app/`: Contains the core application code, including controllers, models, and services.
- `bootstrap/`: Contains the application bootstrapping script.
- `config/`: Contains configuration files for various services and packages.
- `database/`: Contains database migrations, seeders, and factories.
- `public/`: Contains publicly accessible files, including the entry point for the application.
- `resources/`: Contains view templates, language files, and other frontend resources.
- `routes/`: Contains route definitions for the application.
- `storage/`: Contains logs, compiled Blade templates, file uploads, and other storage.
- `tests/`: Contains test cases for the application.
- `vendor/`: Contains third-party packages installed via Composer.

# Executing
To execute the project, follow these steps:

1. Clone the repository:
   ```sh
   git clone <repository-url>
   ```
2. Navigate to the project directory:
   ```sh
   cd <project-directory>
   ```
3. Install the dependencies:
   ```sh
   composer install
   ```
4. Copy the example environment file and configure it:
   ```sh
   cp .env.example .env
   ```
5. Generate the application key:
   ```sh
   php artisan key:generate
   ```
6. Run the database migrations:
   ```sh
   php artisan migrate
   ```
7. Start the development server:
   ```sh
   php artisan serve
   ```

# Navigation
To navigate and test the different sections of the project, follow these steps:

1. **Home Page**: Access the home page by visiting `http://localhost:8000`.
2. **Login**: Navigate to the login page at `http://localhost:8000/login`.
3. **Register**: Navigate to the registration page at `http://localhost:8000/register`.
4. **Admin Panel**: Access the admin panel at `http://localhost:8000/admin`.
5. **Events**: Manage events at `http://localhost:8000/events`.
6. **User Profile**: Access user profile at `http://localhost:8000/user`.
7. **Reports**: Manage reports at `http://localhost:8000/report`.

> This will be changed
# Testing
The project includes test cases to ensure the correctness of the application.
To run the test cases for the application, execute the following command:
```sh
php artisan test
```

You may also run specific test cases by providing the path to the test file or directory:
```sh
php artisan test tests/Feature/ExampleTest.php
```

You can find the test cases in the `tests/` directory.

# API
For detailed API documentation, refer to [backend-api-doc.md](backend-api-doc.md).
