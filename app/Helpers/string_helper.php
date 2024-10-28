<?php
    if (!function_exists('camel_case')) {
        function camel_case($string) {
            return lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $string))));
        }
    }