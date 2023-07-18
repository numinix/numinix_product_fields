<?php
  (isset($_POST['products_secret'])) ? $sql_data_array['products_secret'] = zen_db_prepare_input($_POST['products_secret']) : '';
  // eof