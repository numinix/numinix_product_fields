<?php
  if( !isset($_POST['online_only']) ) $_POST['air_ononline_only'] = 0; 
  $sql_data_array['online_only'] = zen_db_prepare_input($_POST['online_only']);
  // eof