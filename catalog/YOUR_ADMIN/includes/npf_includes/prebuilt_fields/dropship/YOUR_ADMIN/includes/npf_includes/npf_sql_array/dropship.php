<?php
  if( !isset($_POST['dropship']) ) $_POST['dropship'] = 0; 
  $sql_data_array['dropship'] = zen_db_prepare_input($_POST['dropship']);
  // eof