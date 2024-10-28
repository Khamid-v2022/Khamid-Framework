<?php

if (!function_exists('env')) {
    function env($key, $default = null) {
        // load .env file
        static $env = [];

        if (empty($env)) {
            $envFile = __DIR__ . '/../../.env';
            if (file_exists($envFile)) {
                $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                foreach ($lines as $line) {
                    // remove space and comment
                    $line = trim($line);
                    if (strpos($line, '#') === 0) {
                        continue;
                    }

                    // split key and value
                    list($name, $value) = explode('=', $line, 2);
                    // remove surrounding quotes if present
                    $env[trim($name)] = trim($value, '" ');
                }
            }
        }

        return array_key_exists($key, $env) ? $env[$key] : $default;
    }
}