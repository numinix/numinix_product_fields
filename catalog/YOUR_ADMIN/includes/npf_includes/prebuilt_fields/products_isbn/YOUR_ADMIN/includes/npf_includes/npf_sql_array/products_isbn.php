<?php

$sql_data_array['products_upc'] = isset($_POST['products_upc']) ? zen_db_prepare_input($_POST['products_upc']) : '';
$sql_data_array['products_isbn'] = isset($_POST['products_isbn']) ? zen_db_prepare_input($_POST['products_isbn']) : '';
$sql_data_array['products_ean'] = isset($_POST['products_ean']) ? zen_db_prepare_input($_POST['products_ean']) : '';
$sql_data_array['products_asin'] = isset($_POST['products_asin']) ? zen_db_prepare_input($_POST['products_asin']) : '';
