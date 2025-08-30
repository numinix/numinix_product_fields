<?php

global $sniffer;
if ($sniffer->field_exists(TABLE_PRODUCTS, 'products_condition')) {
    $db->Execute(
        "ALTER TABLE " . TABLE_PRODUCTS . " MODIFY products_condition varchar(32) NULL default 'New';"
    );
}
