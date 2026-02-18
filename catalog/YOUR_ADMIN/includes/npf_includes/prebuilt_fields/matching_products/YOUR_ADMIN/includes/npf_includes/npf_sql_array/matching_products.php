<?php

$sql_data_array['matching_color'] = isset($_POST['matching_color']) ? zen_db_prepare_input($_POST['matching_color']) : '';
$sql_data_array['matching_fleece'] = isset($_POST['matching_fleece']) ? zen_db_prepare_input($_POST['matching_fleece']) : '';
$sql_data_array['matching_tank'] = isset($_POST['matching_tank']) ? zen_db_prepare_input($_POST['matching_tank']) : '';
$sql_data_array['matching_gender'] = isset($_POST['matching_gender']) ? zen_db_prepare_input($_POST['matching_gender']) : '';
$sql_data_array['matching_youth'] = isset($_POST['matching_youth']) ? zen_db_prepare_input($_POST['matching_youth']) : '';
$sql_data_array['matching_tshirt'] = isset($_POST['matching_tshirt']) ? zen_db_prepare_input($_POST['matching_tshirt']) : '';
