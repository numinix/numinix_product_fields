<?php
  $sql_data_array['matching_color'] = zen_db_prepare_input($_POST['matching_color']);
  $sql_data_array['matching_fleece'] = zen_db_prepare_input($_POST['matching_fleece']);
  $sql_data_array['matching_tank'] = zen_db_prepare_input($_POST['matching_tank']);
  $sql_data_array['matching_gender'] = zen_db_prepare_input($_POST['matching_gender']);
  $sql_data_array['matching_youth'] = zen_db_prepare_input($_POST['matching_youth']);
  $sql_data_array['matching_tshirt'] = zen_db_prepare_input($_POST['matching_tshirt']);
  // eof