<?php
  $sql_data_array['products_weight_type'] = $products_weight_type;
  $sql_data_array['products_dim_type'] = $products_dim_type;
  $sql_data_array['products_length'] = (float)zen_db_prepare_input($_POST['products_length']);
  $sql_data_array['products_width'] = (float)zen_db_prepare_input($_POST['products_width']);
  $sql_data_array['products_height'] = (float)zen_db_prepare_input($_POST['products_height']);
  $sql_data_array['products_ready_to_ship'] = (int)zen_db_prepare_input($_POST['products_ready_to_ship']);
  $sql_data_array['products_diameter'] = zen_db_prepare_input($_POST['products_diameter']);
  // eof