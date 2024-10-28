<?php
return [
    'name' => env('APP_NAME', 'Forward'),
    'url' => env('APP_URL', 'http://localhost'),
    'debug' => filter_var(env('APP_DEBUG', false), FILTER_VALIDATE_BOOLEAN),
    'timezone' => env('APP_TIMEZONE', 'UTC'),
    'locale' => 'en',
];