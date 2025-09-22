<?php

$sql_data_array['discontinue'] = isset($_POST['discontinue']) ? zen_db_prepare_input($_POST['discontinue']) : 0;
