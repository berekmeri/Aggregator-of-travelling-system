<?php
  declare(strict_types=1);

  /**
   * Class Router
   *
   * Handles routing and dispatching pages based on the `$_GET['page']` parameter.
   * Loads header, page content, and footer. Handles exceptions during page load.
   */
  class Router {
    /** @var System Reference to the system instance */
    private System $system;

    /** @var string Default page to load if none is specified */
    private string $defaultPage = 'externalHome';
    
    /** @var string Current page being loaded */
    private string $currentPage = '';

    /**
     * Constructor
     *
     * @param System $system Reference to the main system
     */
    public function __construct(System $system) {
      $this->system = $system;
    }

    /**
     * Dispatch the requested page
     *
     * Loads header, requested page, and footer. Handles exceptions if page is missing.
     */
    public function dispatch(): void {
      $pageName = $this->getPageName();
      $pageFile = PAGES_PATH . $pageName . '.php';

      $this->currentPage = $pageName;

      try {
        $this->loadHeader();
        $this->loadPage($pageFile);
        $this->loadFooter();
      } catch (Exception $error) {
        $this->handleError($error);
      }
    }

    /**
     * Get the current page name
     *
     * @return string Current page
     */
    public function getCurrentPage(): string {
      return $this->currentPage;
    }

    /**
     * Determine the page to load from $_GET['page']
     *
     * @return string Page name
     */
    private function getPageName(): string {
      $page = $_GET['page'] ?? $this->defaultPage;
      return is_string($page) && !empty($page) ? $page : $this->defaultPage;
    }

    /**
     * Load the header HTML
     *
     * @throws ApplicationException if header file is missing
     */
    private function loadHeader(): void {
      $file = HEADER_PATH . 'header.php';
      if (!file_exists($file)) {
        throw new ApplicationException('Header fájl nem található: ' . $file);
      }
      require_once $file;
    }

    /**
     * Load the main page content
     *
     * @param string $file Path to the page file
     * @throws PageNotFoundException if page file is missing
     */
    private function loadPage($file): void {
      if (!file_exists($file)) {
        throw new PageNotFoundException("Page fájl nem található: $file");
      }
      require_once $file;
    }

    /**
     * Load the footer HTML
     *
     * @throws ApplicationException if footer file is missing
     */
    private function loadFooter(): void {
      $file = FOOTER_PATH . 'footer.php';
      if (!file_exists($file)) {
        throw new ApplicationException('Footer fájl nem található: ' . $file);
      }
      require_once $file;
    }

    /**
     * Handle errors during page dispatch
     *
     * Checks if the exception is a custom exception and renders the appropriate error page
     *
     * @param Exception $error
     */
    private function handleError(Exception $error): void {
      if (ErrorHandler::getCustomException($error)) {
        ErrorHandler::renderError($error->code, $error);
      } else {
        ErrorHandler::renderError(500, $error);
      }
      var_dump($error);
    }
  }
?>