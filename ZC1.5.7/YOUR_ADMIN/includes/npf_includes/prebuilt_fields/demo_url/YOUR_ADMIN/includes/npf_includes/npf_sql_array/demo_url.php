<?php
  (isset($_POST['demo_url'])) ? $sql_data_array['demo_url'] = zen_db_prepare_input($_POST['demo_url']) : '';
  // eof