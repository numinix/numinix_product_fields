<?php

/**
 * @package admin
 * @copyright Copyright 2003-2018 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: Drbyte Mon Nov 12 20:38:09 2018 -0500 New in v1.5.6 $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
if (isset($_POST['products_id']) && isset($_POST['categories_id'])) {
  $products_id = (int)zen_db_prepare_input($_POST['products_id']);
  $categories_id = (int)zen_db_prepare_input($_POST['categories_id']);

// Copy attributes to duplicate product
  $products_id_from = $products_id;

  if ($_POST['copy_as'] == 'link') {
    if ($categories_id != $current_category_id) {
      $check = $db->Execute("SELECT COUNT(*) AS total
                             FROM " . TABLE_PRODUCTS_TO_CATEGORIES . "
                             WHERE products_id = " . (int)$products_id . "
                             AND categories_id = " . (int)$categories_id);
      if ($check->fields['total'] < '1') {
        $db->Execute("INSERT INTO " . TABLE_PRODUCTS_TO_CATEGORIES . " (products_id, categories_id)
                      VALUES ('" . (int)$products_id . "', '" . (int)$categories_id . "')");

        zen_record_admin_activity('Product ' . (int)$products_id . ' copied as link to category ' . (int)$categories_id . ' via admin console.', 'info');
      }
    } else {
      $messageStack->add_session(ERROR_CANNOT_LINK_TO_SAME_CATEGORY, 'error');
    }
  } elseif ($_POST['copy_as'] == 'duplicate') {
    $old_products_id = $products_id;
    $product = $db->Execute("SELECT *
                             FROM " . TABLE_PRODUCTS . "
                             WHERE products_id = " . (int)$products_id . "
                             LIMIT 1");

    // fix Product copy from if Unit is 0
    if ($product->fields['products_quantity_order_units'] == 0) {
      $sql = "UPDATE " . TABLE_PRODUCTS . "
              SET products_quantity_order_units = 1
              WHERE products_id = " . (int)$products_id;
      $db->Execute($sql);
      $product->fields['products_quantity_order_units'] = 1;
    }
    // fix Product copy from if Minimum is 0
    if ($product->fields['products_quantity_order_min'] == 0) {
      $sql = "UPDATE " . TABLE_PRODUCTS . "
              SET products_quantity_order_min = 1
              WHERE products_id = " . (int)$products_id;
      $db->Execute($sql);
      $product->fields['products_quantity_order_min'] = 1;
    }

    $sql_data_array = array();
    $separately_updated_fields = array(
      'products_id',
      'products_status',
      'products_last_modified',
      'products_date_added',
      'products_date_available',
    );
    $casted_fields = array(
      'products_quantity' => 'float',
      'products_price' => 'float',
      'products_weight' => 'float',
      'products_tax_class_id' => 'int',
      'manufacturers_id' => 'int',
      'product_is_free' => 'int',
      'product_is_call' => 'int',
      'products_quantity_mixed' => 'int',
    );

    $product_columns_lookup = array();
    foreach (array_keys($db->metaColumns(TABLE_PRODUCTS)) as $column_name) {
      $product_columns_lookup[strtoupper($column_name)] = true;
    }
    $products_description_columns = array_map('strtolower', array_keys($db->metaColumns(TABLE_PRODUCTS_DESCRIPTION)));

    // -----
    // Give an observer the chance to add any customized fields to the two arrays above.
    //
    $zco_notifier->notify('NOTIFY_MODULES_COPY_PRODUCT_CONFIRM_DUPLICATE_FIELDS', $product, $separately_updated_fields, $casted_fields);

    foreach ($product->fields as $key => $value) {
      if (in_array($key, $separately_updated_fields)) {
        continue;
      }

      if (!isset($product_columns_lookup[strtoupper($key)])) {
        continue;
      }

      $value = zen_db_input($value);
      if (array_key_exists($key, $casted_fields)) {
        if ($casted_fields[$key] == 'int') {
          $sql_data_array[$key] = (int)$value;
        } elseif ($casted_fields[$key] == 'float') {
          $sql_data_array[$key] = (float)$value;
        } else {
          $sql_data_array[$key] = (!zen_not_null($value) || $value == '' || $value == 0) ? 0 : $value;
        }
      } else {
        $sql_data_array[$key] = $value;
      }
    }

    $sql_data_array['products_status'] = 0;
    $sql_data_array['products_date_added'] = 'now()';
    $sql_data_array['products_date_available'] = (!empty($product->fields['products_date_available']) ? zen_db_input($product->fields['products_date_available']) : 'null');
    $sql_data_array['master_categories_id'] = $categories_id;

    zen_db_perform(TABLE_PRODUCTS, $sql_data_array);

    $dup_products_id = (int)$db->Insert_ID();

    $descriptions = $db->Execute("SELECT *
                                  FROM " . TABLE_PRODUCTS_DESCRIPTION . "
                                  WHERE products_id = " . (int)$products_id);
    $products_name_maxlen = zen_field_length(TABLE_PRODUCTS_DESCRIPTION, 'products_name');
    foreach ($descriptions as $description) {
      $description_data = array();
      foreach ($products_description_columns as $column_name) {
        switch ($column_name) {
          case 'products_id':
            $description_data[$column_name] = $dup_products_id;
            break;
          case 'language_id':
            $description_data[$column_name] = (int)$description[$column_name];
            break;
          case 'products_name':
            $name = isset($description[$column_name]) ? $description[$column_name] : '';
            if (defined('TEXT_DUPLICATE_IDENTIFIER')) {
              $prefixed = TEXT_DUPLICATE_IDENTIFIER . " " . $name;
              if (strlen($prefixed) > $products_name_maxlen) {
                $prefixed = substr($prefixed, 0, $products_name_maxlen - 1);
              }
              $name = $prefixed;
            }
            $description_data[$column_name] = $name;
            break;
          default:
            if (array_key_exists($column_name, $description)) {
              $value = $description[$column_name];
              $description_data[$column_name] = ($value === null) ? 'null' : $value;
            }
            break;
        }
      }
      if (!isset($description_data['language_id'])) {
        $description_data['language_id'] = (int)$description['language_id'];
      }
      zen_db_perform(TABLE_PRODUCTS_DESCRIPTION, $description_data);
    }

    $db->Execute("INSERT INTO " . TABLE_PRODUCTS_TO_CATEGORIES . " (products_id, categories_id)
                  VALUES ('" . (int)$dup_products_id . "', '" . (int)$categories_id . "')");
    $products_id = $dup_products_id;

// FIX HERE
/////////////////////////////////////////////////////////////////////////////////////////////
// Copy attributes to duplicate product
// moved above            $products_id_from=zen_db_input($products_id);
    $products_id_to = $dup_products_id;
    $products_id = $dup_products_id;

    if (!empty($_POST['copy_attributes']) && $_POST['copy_attributes'] == 'copy_attributes_yes') {
      // $products_id_to= $copy_to_products_id;
      // $products_id_from = $pID;
//            $copy_attributes_delete_first='1';
//            $copy_attributes_duplicates_skipped='1';
//            $copy_attributes_duplicates_overwrite='0';

      if (DOWNLOAD_ENABLED == 'true') {
        $copy_attributes_include_downloads = '1';
        $copy_attributes_include_filename = '1';
      } else {
        $copy_attributes_include_downloads = '0';
        $copy_attributes_include_filename = '0';
      }

      zen_copy_products_attributes($products_id_from, $products_id_to);
    }
// EOF: Attributes Copy on non-linked
/////////////////////////////////////////////////////////////////////
    // copy product discounts to duplicate
    if (!empty($_POST['copy_discounts']) && $_POST['copy_discounts'] == 'copy_discounts_yes') {
      zen_copy_discounts_to_product($old_products_id, (int)$dup_products_id);
    }

    zen_record_admin_activity('Product ' . (int)$old_products_id . ' duplicated as product ' . (int)$dup_products_id . ' via admin console.', 'info');
  }

  // reset products_price_sorter for searches etc.
  zen_update_products_price_sorter($products_id);
}
zen_redirect(zen_href_link(FILENAME_CATEGORY_PRODUCT_LISTING, 'cPath=' . $categories_id . '&pID=' . $products_id . (isset($_GET['page']) ? '&page=' . $_GET['page'] : '')));
