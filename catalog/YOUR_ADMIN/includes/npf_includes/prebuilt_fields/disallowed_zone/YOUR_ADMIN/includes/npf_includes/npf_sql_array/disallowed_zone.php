<?php

$sql_data_array['disallowed_zone'] = isset($_POST['disallowed_zone']) ? zen_db_prepare_input($_POST['disallowed_zone']) : 0;
