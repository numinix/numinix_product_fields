<?php

// remove old field functions file
// that function is now included in the npf_functions.php

if(file_exists(DIR_FS_ADMIN.'includes/functions/extra_functions/npf_fields_functions.php')){
         unlink(DIR_FS_ADMIN.'includes/functions/extra_functions/npf_fields_functions.php');
     }

// For Admin Pages
$zc150 = (PROJECT_VERSION_MAJOR > 1 || (PROJECT_VERSION_MAJOR == 1 && substr(PROJECT_VERSION_MINOR, 0, 3) >= 5));
if ($zc150) { // continue Zen Cart 1.5.0
  // delete configuration menu
  $db->Execute("DELETE FROM ".TABLE_ADMIN_PAGES." WHERE page_key = 'catalogNPF' LIMIT 1;");
  // add configuration menu
  if (!zen_page_key_exists('catalogNPF')) {
    if ((int)$configuration_group_id > 0) {
      zen_register_admin_page('catalogNPF',
                              'TEXT_NUMINIX_PRODUCT_FIELDS', 
                              'NUMINIX_PRODUCT_FIELDS_FILENAME',
                              '', 
                              'catalog', 
                              'Y',
                              $configuration_group_id);
        
      $messageStack->add('Enabled Numinix Product Fields Catalog Menu Item.', 'success');
    }
  }
}

global $sniffer;
if (!$sniffer->field_exists(TABLE_PRODUCTS, 'products_condition'))  $db->Execute("ALTER TABLE ".TABLE_PRODUCTS." ADD products_condition varchar(32) NULL default NULL;");

$condition_query = $db->Execute("SELECT configuration_key FROM ".TABLE_PRODUCT_TYPE_LAYOUT." WHERE configuration_key='SHOW_PRODUCT_INFO_CONDITION'");
        if($condition_query->Recordcount() == 0){
            $db->Execute("INSERT INTO ".TABLE_PRODUCT_TYPE_LAYOUT." (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, last_modified, date_added, use_function, set_function) VALUES 
            (NULL, 'Show Condition', 'SHOW_PRODUCT_INFO_CONDITION', '0', 'Show product condition on product info page (requires Numinix Product Fields)?', 1, 17, NULL, NOW(), NULL, 'zen_cfg_select_option(array(\'1\', \'0\'),');");
        }