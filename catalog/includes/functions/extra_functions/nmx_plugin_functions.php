<?php

if (!function_exists('nmx_create_defines')) {
    function nmx_create_defines($defines = array())
    {
        if (is_array($defines) && count($defines) > 0) {
            foreach ($defines as $constantName => $constantValue) {
                if (!defined($constantName)) {
                    define($constantName, $constantValue);
                }
            }
        }
    }
}
