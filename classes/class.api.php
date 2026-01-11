<?php
  declare(strict_types=1);

  class API {
    /** @var System Reference to the system instance */
    private System $system;
    
    
    /**
    * API constructor.
    *
    * Determines the request method and routes
    * the request to the appropriate handler.
    *
    * @param System $system Reference to the main system
    */
    public function __construct(System $system) {
      $this->system = $system;

      // Route request based on HTTP method
      switch ($_SERVER['REQUEST_METHOD']) {
        case 'POST':
          $this->handlePost();
          break;
        case 'GET':
          $this->handleGet();
          break;
        default:
          http_response_code(405);
      }
    }

    /**
     * Handles POST requests
     *
     * Outputs received form data
     */
    private function handlePost(): void {
      // @Todo: Implement real POST handling logic
      var_dump($_POST);
    }

    /**
     * Handles GET requests
     *
     * Outputs received query parameters
     */
    private function handleGet(): void {
      header('Content-Type: application/json; charset=utf-8');

      $action = $_GET['action'] ?? null;

      // @Todo: Implement real GET handling logic
      switch ($action) {
        case 'trips':
          usleep(1500000); // @Todo: Remove
          echo json_encode($this->mockTrips());
          break;

        default:
          http_response_code(400);
          echo json_encode([
            'error' => 'Ismeretlen API művelet'
          ]);
      }
    }

    private function mockTrips(): array {
      // @Todo: Remove trips
      $trips = [];

      for ($i = 1; $i <= 30; $i++) {
        $trips[] = [
          'id' => $i,
          'destination' => 'Barcelona',
          'from' => '2026-04-12',
          'to' => '2026-04-18',
          'price' => rand(180000, 350000),

          'flight' => [
            'provider' => 'Wizz Air',
            'from' => 'Budapest',
            'to' => 'Barcelona',
            'departure' => '04:45',
            'arrival' => '07:20'
          ],

          'hotel' => [
            'name' => 'Hotel Marina',
            'nights' => 5,
            'extras' => ['reggeli', 'wifi'],
            'rating' => rand(75, 95) / 10
          ]
        ];
      }

      return [
        'count' => count($trips),
        'data' => $trips
      ];
    }
  }
?>