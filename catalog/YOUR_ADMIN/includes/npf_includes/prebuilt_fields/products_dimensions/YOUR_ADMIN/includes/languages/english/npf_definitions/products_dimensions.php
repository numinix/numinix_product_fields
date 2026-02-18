<?php
if (!defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
}

$define = [
    'TEXT_PRODUCTS_DIM_UNITS'              => 'Select Dimensional Units: ',
    'TEXT_PRODUCTS_WEIGHT_UNITS'           => 'Select Weight Units: ',
    'TEXT_PRODUCTS_DIM_TYPE'               => 'Inches or Centimetres',
    'TEXT_PRODUCTS_WEIGHT_TYPE'            => 'Pounds or Kilograms',
    'TEXT_PRODUCTS_LENGTH'                 => 'Length',
    'TEXT_PRODUCTS_WIDTH'                  => 'Width',
    'TEXT_PRODUCTS_HEIGHT'                 => 'Height',
    'UNITS_KGS'                            => 'kgs',
    'UNITS_LBS'                            => 'lbs',
    'UNITS_CM'                             => 'cm',
    'UNITS_IN'                             => 'in',
    'TEXT_PRODUCTS_READY_TO_SHIP'          => 'Ready to Ship',
    'TEXT_PRODUCTS_READY_TO_SHIP_SELECTION' => 'Item ships in its original box (ie: no extra packaging charges)? ',
    'TEXT_PRODUCTS_DIAMETER'               => 'Diameter: ',
    'TEXT_PRODUCTS_ACTUAL_WEIGHT'          => 'Actual Weight: ',
];

$zc158 = (PROJECT_VERSION_MAJOR > 1 || (PROJECT_VERSION_MAJOR == 1 && substr(PROJECT_VERSION_MINOR, 0, 3) >= '5.8'));
if ($zc158) {
    return $define;
} else {
    nmx_create_defines($define);
}
