<?php
  declare(strict_types=1);

  /**
   * Class UnauthorizedException
   * 
   * Exception thrown when a user tries to access a restricted resource.
   * Typically results in HTTP 401.
   */
  class UnauthorizedException extends Exception {
    /** @var int HTTP code for this exception */
    public $code = 401;
    
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