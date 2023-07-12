<?php
  (isset($_POST['products_condition'])) ? $sql_data_array['products_condition'] = zen_db_prepare_input($_POST['products_condition']) : $sql_data_array['products_condition'] = '';
  // eof
                            