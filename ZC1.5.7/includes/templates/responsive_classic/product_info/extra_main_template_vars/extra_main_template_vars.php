<?php

global $sniffer, $db;
//$sniffer->field_exists(TABLE_CONFIGURATION, 'configuration_tab')
if (!empty(NUMINIX_PRODUCT_FIELDS_CATALOGUE)) {
	$select = array();
	$numinix_fields = explode(',', NUMINIX_PRODUCT_FIELDS_CATALOGUE);

	foreach ($numinix_fields as $field) {
		$field = trim($field); // modified for NX-1962 :: Issue on NPF
		if ($sniffer->field_exists(TABLE_PRODUCTS, $field)) {
			$select[] = $field;
		}
	}
	if (count($select) > 0) {
		$sql_query = 'SELECT ' . implode(',', $select) . ' FROM ' . TABLE_PRODUCTS . ' WHERE products_id = :products_id';
		$sql_query = $db->bindVars($sql_query, ':products_id', $_GET['products_id'], 'integer');

		$sql = $db->Execute($sql_query);
		foreach ($numinix_fields as $field) {
			if (!empty($sql->fields[$field])) { // bof modified for NX-1962 :: Issue on NPF
				$numinix_fields_display[$field] = $sql->fields[$field];
			} // eof modified for NX-1962 :: Issue on NPF
		}
	}
}
