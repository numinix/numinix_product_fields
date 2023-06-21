<?php
  (isset($_POST['discontinue'])) ? $sql_data_array['discontinue'] = zen_db_prepare_input($_POST['discontinue']) : '';
  // eof