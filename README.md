# PHP + AJAX Projekt (English)
## Overview
This project is a PHP-based web application using AJAX for dynamic functionality. The system is structured to separate concerns clearly: classes, configuration, layouts, assets, and error handling.

The project includes:

- A custom **Router** for page dispatching.
- A **System** class to initialize and run the application.
- An **ErrorHandler** for handling runtime and custom exceptions.
- Support for **custom exceptions** like `ApplicationException`, `PageNotFoundException`, and `UnauthorizedException`.

## Directory Structure
```powershell
project-root/
├─ classes/                 # PHP class
│   └─ exceptions/          # Custom exceptions
├─ config/                  # Configuration files
└─ layouts/                 
     ├─ assets/             # CSS, JS, images
     ├─ errors/             # Error pages (e.g., 404.php)
     ├─ footer/             # Footer HTML
     ├─ header/             # Header HTML
     └─ pages/              # Main page content

```

## Configuration
All paths and settings are defined in `config/config.php`:
- `ROOT` – project root path
- `CLASSES_PATH` – path to classes
- `LAYOUTS_PATH` – path to layouts
- `HEADER_PATH`, `FOOTER_PATH`, `PAGES_PATH`, `ERRORS_PATH`, `ASSETS_PATH` – paths to respective subdirectories
- `MAINTENANCE` – if `true`, detailed errors are displayed for debugging

## Running the Application
Entry point: `index.php`
1. Instantiate the `System` class.
2. Call `$system->run()` to dispatch the router.
3. Router loads `header`, page content from `$_GET['page']`, and `footer`.

> - Example URL: `http://yourdomain.com/index.php?page=home`
> - `home` corresponds to `layouts/pages/home.php`.
> - If the page does not exist, `PageNotFoundException` is thrown, showing `layouts/errors/404.php`.

## Navigation
Pages are loaded dynamically using: `$_GET['page']`
> - Default page: `externalHome`
> - Example: `index.php?page=about` → loads `layouts/pages/about.php`

## Custom Exceptions
- `ApplicationException` – general runtime error
- `PageNotFoundException` – triggered when a page file is missing (HTTP 404)
- `UnauthorizedException` – access restriction (HTTP 401)

### Throwing Custom Exceptions
```php
throw new ApplicationException("Something went wrong!");
throw new PageNotFoundException("Page not found!");
throw new UnauthorizedException("Access denied!");
```

## Error Handling
- Runtime errors are converted to exceptions automatically.
- All uncaught exceptions go through `ErrorHandler::renderError()`.
- The system checks for specific error pages (`errors/404.php`) or uses a fallback `errors/error.php`.
- Maintenance mode shows full stack trace for debugging.