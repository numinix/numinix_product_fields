<?php
function zen_get_care_instructions($product_id, $language_id) {
  global $db;
  $product = $db->Execute("select care_instructions
                           from " . TABLE_PRODUCTS_DESCRIPTION . "
                           where products_id = '" . (int)$product_id . "'
                           and language_id = '" . (int)$language_id . "'");

  return $product->fields['care_instructions'];
}