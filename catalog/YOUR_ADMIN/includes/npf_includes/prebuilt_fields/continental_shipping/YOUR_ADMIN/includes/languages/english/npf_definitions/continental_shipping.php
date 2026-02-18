<?php

if (!defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
}

$define = [
    'TEXT_PRODUCTS_ASA_SHIPPING' => 'Flat Rate Shipping Rates ',
    'TEXT_PRODUCTS_SH_NA'       => 'North America: ',
    'TEXT_PRODUCTS_SH_SA'       => 'South America: ',
    'TEXT_PRODUCTS_SH_EU'       => 'Europe: ',
    'TEXT_PRODUCTS_SH_AS'       => 'Asia: ',
    'TEXT_PRODUCTS_SH_AU'       => 'Australia: ',
    'TEXT_PRODUCTS_SH_AF'       => 'Africa: ',
];

$zc158 = (PROJECT_VERSION_MAJOR > 1 || (PROJECT_VERSION_MAJOR == 1 && substr(PROJECT_VERSION_MINOR, 0, 3) >= '5.8'));
if ($zc158) {
    return $define;
} else {
    nmx_create_defines($define);
}
