<?php

$sql_data_array['additional_skus'] = isset($_POST['additional_skus']) ? zen_db_prepare_input($_POST['additional_skus']) : '';
$sql_data_array['additional_skus_only'] = isset($_POST['additional_skus_only']) ? zen_db_prepare_input($_POST['additional_skus_only']) : 0;
