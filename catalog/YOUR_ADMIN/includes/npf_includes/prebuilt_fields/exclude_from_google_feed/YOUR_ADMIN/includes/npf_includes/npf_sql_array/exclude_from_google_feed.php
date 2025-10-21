<?php

$sql_data_array['exclude_from_google_feed'] = isset($_POST['exclude_from_google_feed']) ? zen_db_prepare_input($_POST['exclude_from_google_feed']) : 0;
