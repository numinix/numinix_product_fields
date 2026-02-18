<?php

$sql_data_array['products_secret'] = isset($_POST['products_secret']) ? zen_db_prepare_input($_POST['products_secret']) : 0;
