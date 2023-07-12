<?php


/*
 * npf_field_value to obtain a product field for display/use in catalog
 * Example use of function:
 * echo npf_field_value($product_id,'products_msrp');  
 */

if (!function_exists('npf_field_value')) {
    function npf_field_value($id, $field){
        global $db;
        $product = $db->Execute("SELECT * FROM ".TABLE_PRODUCTS." WHERE products_id=".(int)$id." LIMIT 1");
            $value = $product->fields[$field];
            return $value;
    }
 }

