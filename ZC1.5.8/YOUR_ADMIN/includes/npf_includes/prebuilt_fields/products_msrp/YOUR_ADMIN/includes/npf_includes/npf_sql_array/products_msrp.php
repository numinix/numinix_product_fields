<?php
  (isset($_POST['products_msrp'])) ? $sql_data_array['products_msrp'] = zen_db_prepare_input($_POST['products_msrp']) : '';
  // eof