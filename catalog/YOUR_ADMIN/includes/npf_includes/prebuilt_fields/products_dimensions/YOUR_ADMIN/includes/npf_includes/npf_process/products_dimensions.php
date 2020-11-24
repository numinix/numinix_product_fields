<?php
  $tmp_value = zen_db_prepare_input($_POST['products_weight_type']);
  $products_weight_type = (!zen_not_null($tmp_value) || $tmp_value=='') ? SYSTEM_WEIGHT_UNITS : $tmp_value;
  $tmp_value = zen_db_prepare_input($_POST['products_dim_type']);
  $products_dim_type = (!zen_not_null($tmp_value) || $tmp_value=='') ? SYSTEM_DIMENSION_UNITS : $tmp_value;
  $tmp_value = zen_db_prepare_input($_POST['products_actual_weight']);
  $products_diameter = (!zen_not_null($tmp_value) || $tmp_value=='' || $tmp_value == 0) ? 0 : $tmp_value;
  // eof