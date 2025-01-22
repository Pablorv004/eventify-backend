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
Once the project has been executed, you may navigate and test the different sections of the project.
To do so, follow these steps:

1. **Home Page**: Access the home page by visiting `http://localhost:8000`. It should look something like this:
   ![Home Page](https://i.imgur.com/RLNWL03.png)
2. **Register**: To create an account, visit the register page at `http://localhost:8000/register`. You may fill in the blanks as shown below, or try out the validation by inputting weird data:
   ![Register Page](https://i.imgur.com/cfboFjt.png)
3. **Register Verification**: Upon a successful registration, you'll be asked to verify by Email. It should look something like this:
   ![Register Validation](https://i.imgur.com/BpOnQlv.png)
4. **Register Validation**: Once verified, you may have to validate your account with an admin account. To do so, you'll have to login as an administrator. You may use your personal database for it, although we have a mock account for these cases: User: admin@admin.com - Password: 12345678
Once logged in, visit the admin panel at `http://localhost:8000/admin`. It should look something like this:
   ![Admin Panel](https://i.imgur.com/jPXEdnh.png) 
Find your user and click the "key" icon to validate it. It should be red now, indicating that your account is validated.
5. **User Role**: With the admin credentials, visit the admin panel at `http://localhost:8000/admin`. In your users 'Edit' screen you may find a way to change its role. For now, leave it as 'user', although we will change it later for Organizer testing purposes.
6. **User - Events**: As user, you may visit `http://localhost:8000/user`. Here you'll find a list of currently ongoing events you may be interesting in joining. You may filter by category and Your/All Events. You may also register and unregister for each event. It should look something like this:
   ![User Events](https://i.imgur.com/I2tDQc2.png)
7. **User - Reports**: As user, you can visit the 'My Events' Section in `http://localhost:8000/user`. Here you can generate a report of events you've visited. You may also download the report. The report looks something like this:
   ![User Reports](https://i.imgur.com/YBYd4a0.png)
8. **Organizer - Viewing Events**: Following the steps mentioned in the 'User Role' section, you may change your role to 'organizer', although we have another organizer mock account if you're interested: User: organizer@organizer.com - Password: 12345678.
Once done, visit `http://localhost:8000/events` with your organizer account. You'll find a new tab called 'My Events'. Here you may create new events, edit them, and delete them. You may filter by your own events or by category. It should look something like this:
   ![Organizer Events](https://i.imgur.com/DySzbTp.png)

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
For detailed API documentation, refer to [backend-api-doc.md](documentation/backend-api-doc.md).

