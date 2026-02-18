<?php

global $sniffer, $db;

$numinix_fields_display = [];
if (!empty(NUMINIX_PRODUCT_FIELDS_CATALOGUE)) {
    $select = [];
    $numinix_fields = explode(',', NUMINIX_PRODUCT_FIELDS_CATALOGUE);

    foreach ($numinix_fields as $field) {
        $field = trim($field); // modified for NX-1962 :: Issue on NPF
        if ($sniffer->field_exists(TABLE_PRODUCTS, $field)) {
            $select[] = $field;
        }
    }
    
    if (!empty($select)) {
        $sql_query = 'SELECT ' . implode(',', $select) . ' FROM ' . TABLE_PRODUCTS . ' WHERE products_id = :products_id';
        $sql_query = $db->bindVars($sql_query, ':products_id', (int)$_GET['products_id'], 'integer');

        $sql = $db->Execute($sql_query);
        foreach ($numinix_fields as $field_to_show) {
            $field_to_show = trim($field_to_show);
            if (!empty($sql->fields[$field_to_show])) { // bof modified for NX-1962 :: Issue on NPF
                $numinix_fields_display[$field_to_show] = $sql->fields[$field_to_show];
            } // eof modified for NX-1962 :: Issue on NPF
        }
    }
}
