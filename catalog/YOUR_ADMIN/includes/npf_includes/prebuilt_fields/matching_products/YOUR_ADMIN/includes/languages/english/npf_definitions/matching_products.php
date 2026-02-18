<?php
if (!defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
}

$define = [
    'TEXT_PRODUCTS_MATCHING_COLOR'  => 'Other Products - Color: ',
    'TEXT_PRODUCTS_MATCHING_FLEECE' => 'Other Products - Fleece: ',
    'TEXT_PRODUCTS_MATCHING_TANK'   => 'Other Products - Tank Top: ',
    'TEXT_PRODUCTS_MATCHING_TSHIRT' => 'Other Products - T-Shirt: ',
    'TEXT_PRODUCTS_MATCHING_GENDER' => 'Other Products - Women\'s: ',
    'TEXT_PRODUCTS_MATCHING_YOUTH'  => 'Other Products - Youth: ',
];

$zc158 = (PROJECT_VERSION_MAJOR > 1 || (PROJECT_VERSION_MAJOR == 1 && substr(PROJECT_VERSION_MINOR, 0, 3) >= '5.8'));
if ($zc158) {
    return $define;
} else {
    nmx_create_defines($define);
}
