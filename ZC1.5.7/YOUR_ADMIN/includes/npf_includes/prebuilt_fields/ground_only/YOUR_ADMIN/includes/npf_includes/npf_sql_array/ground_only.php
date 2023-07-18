<?php
  (isset($_POST['ground_only'])) ? $sql_data_array['ground_only'] = zen_db_prepare_input($_POST['ground_only']) : '';
  // eof