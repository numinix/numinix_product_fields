<?php

$sql_data_array['dropship'] = isset($_POST['dropship']) ? zen_db_prepare_input($_POST['dropship']) : 0;
