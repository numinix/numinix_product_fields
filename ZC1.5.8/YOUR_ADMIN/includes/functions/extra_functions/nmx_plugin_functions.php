<?php
if(!function_exists('nmx_create_defines')) {
    function nmx_create_defines($defines=array()){
        if(is_array($defines) && count($defines) > 0) {
            foreach ($defines as $key => $value) {
                if (!defined($key)) @define($key, $value);
            }
        }
    }
}
?>