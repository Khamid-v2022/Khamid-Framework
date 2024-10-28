<?php
namespace Khamid\Framework\Core;

class BaseController {
    /**
     * Render a view file with the provided data
     *
     * @param string $view Name of the view file (without extension)
     * @param array $data Array of data to be passed to the view
     */
    protected function view($view, $data = []) {
        // Convert data array into individual variables
        extract($data);

        // Create the path for the view file
        $viewPath = __DIR__ . '/../Views/' . $view . '.php';

        // Check if the view file exists, and include it if it does
        if (file_exists($viewPath)) {
            require $viewPath;
        } else {
            // Display an error message if the view file is not found
            echo "View file not found: " . $viewPath;
        }
    }

    /**
     * Redirect to a specified URL
     *
     * @param string $url The URL to redirect to
     */
    protected function redirect($url) {
        header("Location: " . $url);
        exit;
    }
}