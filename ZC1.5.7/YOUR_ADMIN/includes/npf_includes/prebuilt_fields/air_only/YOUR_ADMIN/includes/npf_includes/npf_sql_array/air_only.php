<?php
  (isset($_POST['air_only'])) ? $sql_data_array['air_only'] = zen_db_prepare_input($_POST['air_only']) : '';
  // eof