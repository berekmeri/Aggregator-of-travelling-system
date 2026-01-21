<?php
  declare(strict_types=1);
  
  /**
   * Class System
   *
   * Main system class. Initializes components like Router and database connection.
   * Handles application execution.
   */
  class System {
    /** @var Router The router instance */
    public Router $router;

    /**
     * Constructor
     *
     * Initializes the system components
     */
    public function __construct() {
      $this->init();
    }

    /**
     * Initialize system components
     *
     * @todo Connect to database, initialize session, etc.
     */
    private function init(): void {
      $this->router = new Router($this);
    }

    /**
     * Runs the system lifecycle
     *
     * Dispatches the router and initializes the API
     * handler when the current page is an API request.
     */
    public function run(): void {
      // Handle API requests separately
      if ($this->router->currentPage === 'api') {
        new API($this);
      }
      // Resolve and dispatch the current route
      else {
        $this->router->dispatch();
      }
    }
  }
?>