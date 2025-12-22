<?php
  declare(strict_types=1);

  require_once __DIR__ . DIRECTORY_SEPARATOR .'config' . DIRECTORY_SEPARATOR . 'config.php';

  /*
  * Autoloader for classes
  * Automatically includes class files from the classes directory when a class is used
  */
  spl_autoload_register(function(string $class) {
    $file = CLASSES_PATH . 'class.' . strtolower($class) . '.php';
    if (file_exists($file)) {
      require_once $file;
    }
  });

  /*
  * Register the global error and exception handlers
  */
  ErrorHandler::register();

  /*
  * Initialize the system and run the application
  * - Creates a System instance
  * - Dispatches the router to load the requested page
  */
  $system = new System();
  $system->run();
?>