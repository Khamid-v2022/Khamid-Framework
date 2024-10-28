<?php

    if (!function_exists('base_url')) {
        function base_url($path = '') {
            $baseURL = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/') . '/';
            return $baseURL . ltrim($path, '/');
        }
    }