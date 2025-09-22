<?php

function zen_get_care_instructions($product_id, $language_id)
{
    global $db;
    $product = $db->Execute(
        "SELECT `care_instructions`
        FROM `" . TABLE_PRODUCTS_DESCRIPTION . "`
        WHERE `products_id` = '" . (int)$product_id . "'
        AND `language_id` = '" . (int)$language_id . "'"
    );

    return $product->fields['care_instructions'];
}
