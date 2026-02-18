<?php

$sql_data_array['group_pricing_eligible'] = isset($_POST['group_pricing_eligible']) ? zen_db_prepare_input($_POST['group_pricing_eligible']) : 0;
