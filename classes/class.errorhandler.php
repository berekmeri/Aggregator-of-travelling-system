<?php
  declare(strict_types=1);

  // Automatically load all exception classes from the exceptions directory
  $exceptionsDir = CLASSES_PATH . 'exceptions' . DIRECTORY_SEPARATOR;
  foreach (glob($exceptionsDir . '*.php') as $file) {
    require_once $file;
  }

  /**
   * Class ErrorHandler
   *
   * Handles PHP errors, uncaught exceptions, and fatal shutdown errors.
   * Can render error pages or show full debug info if MAINTENANCE mode is enabled.
   */
  class ErrorHandler {
    /**
     * Registers error and exception handlers
     */
    public static function register(): void {      
      // Convert runtime errors to Exceptions
      set_error_handler([self::class, 'handleError']);
      
      // Handling Uncaught Exceptions
      set_exception_handler([self::class, 'handleException']);

      // Shutdown handler for fatal errors
      register_shutdown_function([self::class, 'handleShutdown']);
    }

    /**
     * Converts runtime errors to ErrorException
     *
     * @param int $severity
     * @param string $message
     * @param string $file
     * @param int $line
     * @throws ErrorException
     */
    public static function handleError(int $severity, string $message, string $file, int $line): void {
      throw new ErrorException($message, 0, $severity, $file, $line);
    }

    /**
     * Handles uncaught exceptions
     *
     * @param Throwable $error
     */
    public static function handleException(Throwable $error) : void {
      self::renderError(500, $error);
    }

    /**
     * Handles fatal errors at shutdown
     */
    public static function handleShutdown(): void {
      $error = error_get_last();
      if ($error) {
        $e = new ErrorException(
          $error['message'],
          0,
          $error['type'],
          $error['file'],
          $error['line']
        );
        self::renderError(500, $e);
      }
    }

    /**
     * Renders error page or debug information
     *
     * @param int $code HTTP status code
     * @param Throwable|null $error Optional error object
     */
    public static function renderError(int $code = 500, ?Throwable $error = null): void {
      if (defined('MAINTENANCE') && MAINTENANCE && $error !== null) {
        echo "<h1>Hiba történt!</h1>";
        echo "<p>{$error->getMessage()}</p>";
        echo "<pre>{$error->getTraceAsString()}</pre>";
      } else {
        $errorFile = ERRORS_PATH . $code . '.php';
        if (file_exists($errorFile)) {
          require_once $errorFile;
        } else {
          $fallback = ERRORS_PATH . 'error.php';
          if (file_exists($fallback)) {
            require_once $fallback;
          } else {
            echo "<h1>Hiba történt: {$code}</h1>";
          }
        }
      }
      exit;
    }

    /**
     * Returns the custom exception if it matches one of the known types
     *
     * @param Exception|null $error
     * @return Exception|null
     */
    public static function getCustomException(?Exception $error): ?Exception {
      $exceptions = [
        ApplicationException::class,
        PageNotFoundException::class,
        UnauthorizedException::class
      ];

      foreach ($exceptions as $exceptionClass) {
        if ($error instanceof $exceptionClass) {
          return $error;
        }
      }

      return null;
    }
  }
?>