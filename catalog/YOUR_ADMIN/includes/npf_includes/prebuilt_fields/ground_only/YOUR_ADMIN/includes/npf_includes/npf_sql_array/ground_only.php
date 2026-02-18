<?php

$sql_data_array['ground_only'] = isset($_POST['ground_only']) ? zen_db_prepare_input($_POST['ground_only']) : 0;
