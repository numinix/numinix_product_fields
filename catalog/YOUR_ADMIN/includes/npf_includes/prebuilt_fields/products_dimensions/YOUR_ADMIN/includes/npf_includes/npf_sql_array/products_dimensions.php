<?php

$sql_data_array['products_weight_type'] = isset($products_weight_type) ? $products_weight_type : '';
$sql_data_array['products_dim_type'] = isset($products_dim_type) ? $products_dim_type : '';
$sql_data_array['products_length'] = isset($_POST['products_length']) ? (float)zen_db_prepare_input($_POST['products_length']) : 0.0;
$sql_data_array['products_width'] = isset($_POST['products_width']) ? (float)zen_db_prepare_input($_POST['products_width']) : 0.0;
$sql_data_array['products_height'] = isset($_POST['products_height']) ? (float)zen_db_prepare_input($_POST['products_height']) : 0.0;
$sql_data_array['products_ready_to_ship'] = isset($_POST['products_ready_to_ship']) ? (int)zen_db_prepare_input($_POST['products_ready_to_ship']) : 0;
$sql_data_array['products_diameter'] = isset($_POST['products_diameter']) ? zen_db_prepare_input($_POST['products_diameter']) : '';
$sql_data_array['products_actual_weight'] = isset($_POST['products_actual_weight']) ? zen_db_prepare_input($_POST['products_actual_weight']) : '';
