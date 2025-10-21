<?php

$sql_data_array['products_condition'] = isset($_POST['products_condition']) ? zen_db_prepare_input($_POST['products_condition']) : '';
