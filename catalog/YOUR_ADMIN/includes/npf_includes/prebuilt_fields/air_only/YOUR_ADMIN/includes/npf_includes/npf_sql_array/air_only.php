<?php

if (!isset($_POST['air_only'])) {
    $_POST['air_only'] = 0;
}
$sql_data_array['air_only'] = zen_db_prepare_input($_POST['air_only']);
