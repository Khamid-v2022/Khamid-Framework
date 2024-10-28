<?php
namespace Khamid\Framework\Core; 

class Router {
    private $routes = []; // Array to hold the routes
    public $currentPath;   // Current requested path
    public $requestMethod; // Current request method

    
    public function __construct() {
        // Set the current path and request method
        $this->currentPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $this->requestMethod = $_SERVER['REQUEST_METHOD'];
    }

    public function route($path, $handler, $method = 'GET') {
        $this->routes[] = [
            'path' => $path,
            'handler' => $handler, // This can now be an array (e.g., [UserController::class, 'index'])
            'method' => strtoupper($method)
        ];
    }

    public function get($path, $handler) {
        $this->route($path, $handler, 'GET');
    }

    public function post($path, $handler) {
        $this->route($path, $handler, 'POST');
    }

    public function put($path, $handler) {
        $this->route($path, $handler, 'PUT');
    }

    public function delete($path, $handler) {
        $this->route($path, $handler, 'DELETE');
    }

    // Method to run the router and call the appropriate handler
    public function run() {
        $requestedPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); // Get the requested path
        $requestedMethod = $_SERVER['REQUEST_METHOD']; // Get the request method

        foreach ($this->routes as $route) {
            // Get the current request path
            // Assuming you've set the request path as $currentPath
            if ($route['path'] === $requestedPath && $route['method'] === $requestedMethod) {
                // Check if the handler is an array
                if (is_array($route['handler'])) {
                    // Instantiate the controller and call the method
                    $controllerClass = $route['handler'][0]; // Get the class name
                    $method = $route['handler'][1]; // Get the method name

                    if (class_exists($controllerClass) && method_exists($controllerClass, $method)) {
                        $controller = new $controllerClass(); // Create Controller instance
                        return $controller->$method(); 
                    } else {
                        // 클래스나 메서드가 존재하지 않는 경우 에러 처리
                        http_response_code(404);
                        echo "404 Not Found: The requested controller or method does not exist.";
                        return;
                    }
                }
            }
        }

        http_response_code(404);
        echo "404 Not Found: The requested route does not exist.";

    }
}