<?php
  declare(strict_types=1);

  /**
   * Class PageNotFoundException
   * 
   * Exception thrown when a requested page cannot be found.
   * Typically results in HTTP 404.
   */
  class PageNotFoundException extends Exception {
    /** @var int HTTP code for this exception */
    public $code = 404;
    
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