<?php
  if( !isset($_POST['products_secret']) ) $_POST['products_secret'] = 0; 
  $sql_data_array['products_secret'] = zen_db_prepare_input($_POST['products_secret']);
  // eof