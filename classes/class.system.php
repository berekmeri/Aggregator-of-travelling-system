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
    private Router $router;

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
      // @Todo:
      //   - Connect DB
      //   - Session

      $this->router = new Router($this);
    }

    /**
     * Run the system
     *
     * Dispatches the router to load the requested page.
     */
    public function run(): void {
      $this->router->dispatch();
    }
  }
?>