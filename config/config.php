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
  // define('CONFIG_PATH', ROOT . 'config' . DIRECTORY_SEPARATOR);
  define('CLASSES_PATH', ROOT . 'classes' . DIRECTORY_SEPARATOR);
  define('LAYOUTS_PATH', ROOT . 'layouts' . DIRECTORY_SEPARATOR);
  define('HEADER_PATH', LAYOUTS_PATH . 'header' . DIRECTORY_SEPARATOR);
  define('PAGES_PATH', LAYOUTS_PATH . 'pages' . DIRECTORY_SEPARATOR);
  define('FOOTER_PATH', LAYOUTS_PATH . 'footer' . DIRECTORY_SEPARATOR);
  
  define('ERRORS_PATH', LAYOUTS_PATH . 'errors' . DIRECTORY_SEPARATOR);
  define('ASSETS_PATH', LAYOUTS_PATH . 'assets' . DIRECTORY_SEPARATOR);
  // define('ASSETS_PATH', ROOT . 'assets' . DIRECTORY_SEPARATOR);

  /*
  * Maintenance mode
  * If true, detailed error messages and stack traces will be displayed
  */
  define('MAINTENANCE', true); // @Todo

  /*
  * Enable PHP error reporting for development
  */
  ini_set('display_errors', '1');
  error_reporting(E_ALL);
?>