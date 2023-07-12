<?php
  $sql_data_array['products_upc'] = zen_db_prepare_input($_POST['products_upc']);
  $sql_data_array['products_isbn'] = zen_db_prepare_input($_POST['products_isbn']);
  $sql_data_array['products_ean'] = zen_db_prepare_input($_POST['products_ean']);
  $sql_data_array['products_asin'] = zen_db_prepare_input($_POST['products_asin']);
  // eof