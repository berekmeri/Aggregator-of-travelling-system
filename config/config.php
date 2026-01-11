<?php
  declare(strict_types=1);

  /*
  * Define important system paths
  * ROOT - project root directory
  * CLASSES_PATH - directory for class files
  * LAYOUTS_PATH - directory for layouts (header, footer, pages, assets, errors)
  * HEADER_PATH, PAGES_PATH, FOOTER_PATH, ERRORS_PATH, ASSETS_PATH - subdirectories
  */
  define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
  define('CLASSES_PATH', ROOT . 'classes' . DIRECTORY_SEPARATOR);
  define('LAYOUTS_PATH', ROOT . 'layouts' . DIRECTORY_SEPARATOR);
  define('HEADER_PATH', LAYOUTS_PATH . 'header' . DIRECTORY_SEPARATOR);
  define('PAGES_PATH', LAYOUTS_PATH . 'pages' . DIRECTORY_SEPARATOR);
  define('FOOTER_PATH', LAYOUTS_PATH . 'footer' . DIRECTORY_SEPARATOR);
  
  define('ERRORS_PATH', LAYOUTS_PATH . 'errors' . DIRECTORY_SEPARATOR);
  define('ASSETS_PATH', LAYOUTS_PATH . 'assets' . DIRECTORY_SEPARATOR);
  define('CSS_PATH', ASSETS_PATH . 'styles' . DIRECTORY_SEPARATOR);
  define('JS_PATH', ASSETS_PATH . 'scripts' . DIRECTORY_SEPARATOR);

  /*
  * Detect current request protocol
  * PROJECT_PROTOCOL - 'http' or 'https' depending on server configuration
  * Handles HTTPS, standard ports and reverse proxy headers
  */
  $isHttps =
    (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
    || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443)
    || (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https');
  define('PROJECT_PROTOCOL', $isHttps ? 'https' : 'http');

  /*
  * Get current host (domain and optional port)
  * PROJECT_HOST - example.com or example.com:8080
  */
  $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
  define('PROJECT_HOST', $host);

  /*
  * Extract hostname without protocol or port
  * PROJECT_HOST_NAME - example.com
  */
  define('PROJECT_HOST_NAME', parse_url(PROJECT_PROTOCOL . '://' . $host, PHP_URL_HOST));

  /*
  * Determine base path of the project
  * Useful when the project is not located in the domain root
  * Example: /myproject
  */
  $scriptName = $_SERVER['SCRIPT_NAME']; 
  $basePath = rtrim(str_replace(basename($scriptName), '', $scriptName), '/');
  define('PROJECT_BASE_PATH', $basePath);

  /*
  * Full project base URL
  * Combines protocol, host and base path
  * Example: https://example.com/myproject
  */
  define(
    'PROJECT_URL',
    PROJECT_PROTOCOL . '://' . PROJECT_HOST . PROJECT_BASE_PATH
  );

  /*
  * Maintenance mode
  * If true, detailed error messages and stack traces will be displayed
  */
  define('MAINTENANCE', true);

  /*
  * Enable PHP error reporting for development
  */
  ini_set('display_errors', '1');
  error_reporting(E_ALL);
?>