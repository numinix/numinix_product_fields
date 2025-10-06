<?php

/**
 * product_info.php
 *
 * @package page
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: numinix_product_fields.php 4 2011-09-28 01:00:29Z numinix $
 */

$define = [
    'TEXT_PRODUCTS_ACTUAL_WEIGHT' => 'Products Weight: ',
    'TEXT_PRODUCT_DIMENSIONS' => 'Dimensions: ',
    'TEXT_PRODUCTS_LENGTH' => '',
    'TEXT_PRODUCTS_WIDTH' => '',
    'TEXT_PRODUCTS_HEIGHT' => '',
    'TEXT_PRODUCTS_DIAMETER' => 'Diameter: ',
    'TEXT_PRODUCTS_CONDITION' => 'Condition: ',
    'TEXT_PRODUCTS_UPC' => 'UPC: ',
    'TEXT_PRODUCTS_ISBN' => 'ISBN: ',
    'TEXT_PRODUCTS_OUT_OF_STOCK' => 'Out of Stock',
    'TEXT_PRODUCTS_SKU' => 'SKU: '
];

$zc158 = (PROJECT_VERSION_MAJOR > 1 || (PROJECT_VERSION_MAJOR == 1 && substr(PROJECT_VERSION_MINOR, 0, 3) >= '5.8'));
if ($zc158) {
    return $define;
} else {
    nmx_create_defines($define);
};
