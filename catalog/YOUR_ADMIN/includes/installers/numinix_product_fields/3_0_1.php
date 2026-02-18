<?php

$db->Execute(
    "INSERT INTO " . TABLE_CONFIGURATION . " (configuration_group_id, configuration_key, configuration_title, configuration_value, configuration_description) 
    VALUES (" . (int) $configuration_group_id . ", 'NUMINIX_PRODUCT_FIELDS_CATALOGUE', 'Fields to display on product info page', 'products_sku', 'Enter the fields you want to display on products info page. (Seperated by commas)' );"
);
