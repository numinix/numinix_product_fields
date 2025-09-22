<?php

$sql_data_array['products_sku'] = isset($_POST['products_sku']) ? zen_db_prepare_input($_POST['products_sku']) : '';
