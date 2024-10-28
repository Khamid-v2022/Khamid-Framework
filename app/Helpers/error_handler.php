<?php
    // Error handler setting up
    set_error_handler(function ($errno, $errstr, $errfile, $errline) {
        if (config('app.debug')) {
            // If debug mode is true, trigger the default PHP error
            return false; // Returning false will let PHP handle it
        } else {
            // Throw an ErrorException for non-debug mode
            throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
        }
    });

    // error exception handler
    set_exception_handler(function ($exception) {
        // Get the APP_DEBUG setting value
        $debugMode = config('app.debug');

        if ($debugMode) {
            // If debug mode is true, show the default error message
            echo '<pre>';
            echo 'Error: ' . $exception->getMessage() . "\n";
            echo 'File: ' . $exception->getFile() . "\n";
            echo 'Line: ' . $exception->getLine() . "\n";
            echo '</pre>';
        } else {
            // If debug mode is false, show a 500 error page
            http_response_code(500);
            // echo "A server error has occurred. Please try again later.";
        }
    });

    // Enable PHP error reporting
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);