<?php
  if( !isset($_POST['discontinue']) ) $_POST['discontinue'] = 0; 
  $sql_data_array['discontinue'] = zen_db_prepare_input($_POST['discontinue']);
  // eof