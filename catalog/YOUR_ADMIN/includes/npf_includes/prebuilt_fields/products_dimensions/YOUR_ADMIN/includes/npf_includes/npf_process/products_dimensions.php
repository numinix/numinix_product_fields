<?php

$shipping_weight_units = defined('SHIPPING_WEIGHT_UNITS') ? SHIPPING_WEIGHT_UNITS : 'lbs';
$products_weight_type = (isset($_POST['products_weight_type']) && zen_not_null(zen_db_prepare_input($_POST['products_weight_type'])))
  ? zen_db_prepare_input($_POST['products_weight_type'])
  : $shipping_weight_units;

$shipping_dimension_units = defined('SHIPPING_DIMENSION_UNITS') ? SHIPPING_DIMENSION_UNITS : 'inches';
$products_dim_type = (isset($_POST['products_dim_type']) && zen_not_null(zen_db_prepare_input($_POST['products_dim_type'])))
  ? zen_db_prepare_input($_POST['products_dim_type'])
  : $shipping_dimension_units;

$products_diameter = isset($_POST['products_diameter']) && zen_not_null(zen_db_prepare_input($_POST['products_diameter']))
  ? zen_db_prepare_input($_POST['products_diameter'])
  : 0;
