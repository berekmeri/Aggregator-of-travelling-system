<?php
  declare(strict_types=1);

  /**
   * Class ApplicationException
   * 
   * Custom exception for general application errors.
   * Used when an unexpected error occurs in the system.
   */
  class ApplicationException extends Exception {
    /** @var int HTTP code for this exception */
    public $code = 500;

    /**
     * Constructor
     *
     * @param string|null $error Optional error message
     */
    public function __construct(?string $error = null) {
      parent::__construct($error);
    }
  }
?>