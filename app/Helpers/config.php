<?php

    if (!function_exists('config')) {
        function config($key, $default = null) {
            // Load config files
            static $config = [];
        
            if (empty($config)) {
                $configDir = __DIR__ . '/../..//config/'; 
        
                // Load all files in the config directory 
                $files = scandir($configDir);
        
                foreach ($files as $file) {
                    if (pathinfo($file, PATHINFO_EXTENSION) === 'php') {
                        $configFile = $configDir . $file;
                        $configArray = include($configFile);
                        if (is_array($configArray)) {
                            // Use the file name as the key for the config array
                            $fileKey = pathinfo($file, PATHINFO_FILENAME);
                            $config[$fileKey] = $configArray;
                        }
                    }
                }
            }
    
            // Allow dot notation for accessing nested values
            $keys = explode('.', $key);
            $value = $config;
    
            foreach ($keys as $k) {
                if (isset($value[$k])) {
                    $value = $value[$k];
                } else {
                    return $default; // Return default if key doesn't exist
                }
            }
    
            return $value;
        }
    }