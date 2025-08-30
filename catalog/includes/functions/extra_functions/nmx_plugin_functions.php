<?php

if (!function_exists('nmx_create_defines')) {
    function nmx_create_defines(array $defines = [])
    {
        if (!empty($defines)) {
            foreach ($defines as $key => $value) {
                if (!defined($key)) {
                    @define($key, $value);
                }
            }
        }
    }
}