<?php

function dirList($directory) {
    // create an array to hold directory list
    $results = array();
    // create a handler for the directory
    $handler = opendir($directory);
    // keep going until all files in directory have been read
    while ($file = readdir($handler)) {
        // if $file isn't this directory or its parent, 
        // add it to the results array
        if ($file != '.' && $file != '..')
            $results[] = $file;
    }
    asort($results);
    // tidy up: close the handler
    closedir($handler);
    // done!
    return $results;
}

function zen_get_products_description2($product_id, $language_id) {
    global $db;
    $product = $db->Execute("select products_description2
                           from " . TABLE_PRODUCTS_DESCRIPTION . "
                           where products_id = '" . (int) $product_id . "'
                           and language_id = '" . (int) $language_id . "'");

    return $product->fields['products_description2'];
}

function zen_get_products_video_embed($product_id, $language_id) {
    global $db;
    $product = $db->Execute("select products_video_embed
                           from " . TABLE_PRODUCTS_DESCRIPTION . "
                           where products_id = '" . (int) $product_id . "'
                           and language_id = '" . (int) $language_id . "'");

    return $product->fields['products_video_embed'];
}

function npf_add_prebuilt_fields($field) {
    $array_of_files = array(
        'languages/english/npf_definitions/' . $field . '.php',
        'npf_includes/npf_custom_execute/' . $field . '.php',
        'npf_includes/npf_description_sql_array/' . $field . '.php',
        'npf_includes/npf_modules/' . $field . '.php',
        'npf_includes/npf_process/' . $field . '.php',
        'npf_includes/npf_sql/' . $field . '.php',
        'npf_includes/npf_sql_array/' . $field . '.php',
        'npf_includes/npf_templates/' . $field . '.php',
        'npf_includes/npf_preview/' . $field . '.php',
        'npf_includes/npf_preview_info/' . $field . '.php',
    );
    foreach ($array_of_files as $possible_file) {
        npf_copy_file($field, $possible_file);
        // echo $possible_file.'<br/>';
    }
}

function npf_copy_file($field, $folder) {
    if (file_exists(DIR_FS_ADMIN.NPF_INCLUDES_PREBUILT_FOLDER . $field . '/YOUR_ADMIN/includes/' . $folder)) {
        //echo '!'.$folder.'<br/>';
        $contents = file_get_contents(DIR_FS_ADMIN.NPF_INCLUDES_PREBUILT_FOLDER . $field . '/YOUR_ADMIN/includes/' . $folder);
        file_put_contents(DIR_FS_ADMIN.DIR_WS_INCLUDES . $folder, $contents);
    }
}

function npf_sql_patch($string) {
    global $db;
    $string = str_replace("`", "", $string);
    $string = str_replace(" products ", " " . DB_PREFIX . "products ", $string);
    $string = str_replace(" product_type_layout ", " " . DB_PREFIX . "product_type_layout ", $string);
    $string = str_replace(" products_description ", " " . DB_PREFIX . "products_description ", $string);
    $query_array = explode(';', $string);
    foreach ($query_array as $query) {
        if(strlen($query) > 5) {
            $db->Execute($query.';');
        }
    }
}

if (!function_exists('npf_field_value')) {
    function npf_field_value($id, $field) {
        global $db;
        $product = $db->Execute("SELECT * FROM " . TABLE_PRODUCTS . " WHERE products_id=" . (int) $id . " LIMIT 1");
        $value = $product->fields[$field];
        return $value;
    }
}

function add_custom_field($field_name, $type, $length = '300') {
    global $db,$messageStack;
    $field = str_replace(" ", "_", strtolower($field_name));
    $nice_field_name = ucwords(strtolower(str_replace("_", " ", $field)));
    global $sniffer;
    if ($sniffer->field_exists(TABLE_PRODUCTS, $field)) {
        $messageStack->add('ERROR!! Product field ' . $field . ' already exists', 'caution');
        return;
    }

    $lang_defines = strtoupper($field);
    switch ($type) {
        case "file":
            $sql_type = "varchar(" . $length . ") NULL default NULL";
            $string_input_field = "zen_draw_file_field('".$field."'); if(\$pinfo->" . $field . " != ''){echo \$pinfo->" . $field . ";}";
            break;
        case "checkbox":
            $string_input_field = "zen_draw_checkbox_field('" . $field . "', 1, (\$pInfo->" . $field . ") ? true : false);";
            $sql_type = "tinyint(1) NOT NULL default 0";
            break;
        case "text":
        default:
            $sql_type = "varchar(" . $length . ") NULL default NULL";
            $string_input_field = "zen_draw_input_field('" . $field . "',(\$pInfo->" . $field . "),zen_set_field_length(TABLE_PRODUCTS, '" . $field . "'));";
            break;
    }
    //files
    $string_npf_lang_file = "<?php
                           define('TEXT_" . $lang_defines . "', '" . $nice_field_name . ": ');
                           // eof";
    file_put_contents(NPF_DEFINITIONS_FOLDER . $field . '.php', $string_npf_lang_file);
    $string_npf_sql_file = "<?php
                \$parameters['" . $field . "'] = '';
                \$npf_fields .= ', p." . $field . "'; 
                // eof";
    file_put_contents(NPF_INCLUDES_SQL_FOLDER. $field . '.php', $string_npf_sql_file);
    $string_npf_sql_array_file = "<?php 
                \$sql_data_array['" . $field . "'] = zen_db_prepare_input(\$_POST['" . $field . "']);";
    file_put_contents(NPF_INCLUDES_SQL_ARRAY_FOLDER. $field . '.php', $string_npf_sql_array_file);
    $string_npf_templates_file = "          <tr>
               <td colspan=\"2\"><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
             </tr>          
             <tr bgcolor=\"#DDEACC\">
               <td class=\"main\"><?php echo TEXT_" . $lang_defines . "; ?></td>
               <td class=\"main\"><?php echo zen_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . " . $string_input_field . " ?></td>
             </tr>
             <tr>
               <td colspan=\"2\"><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
             </tr>";
    file_put_contents(NPF_INCLUDES_TEMPLATES_FOLDER. $field . '.php', $string_npf_templates_file);
    if($type = 'file'){
        $process_string = "<?php           
        ";
        file_put_contents(NPF_INCLUDES_PROCESSING_FOLDER . $field . '.php', $process_string);
        $preview_string = "<?php
        if (!isset(\$_GET['read']) || \$_GET['read'] == 'only') {
          \$products_".$field." = new upload('".$field."');
          \$products_".$field."->set_destination(DIR_FS_CATALOG .'media/');
          if (\$products_".$field."->parse() && \$products_".$field."->save(\$_POST['overwrite'])) {
            \$products_".$field."_name = 'media/' . \$products_".$field."->filename;
          } 
        }";
        file_put_contents(NPF_INCLUDES_PREVIEW_FOLDER . $field . '.php', $preview_string);
        $preview_info_string = '<?php 
                echo zen_draw_hidden_field(\''.$field.'\', stripslashes($products_"'.$field.'"_name));';
        file_put_contents(NPF_INCLUDES_PREVIEW_INFO_FOLDER . $field . '.php', $preview_info_string);
    }
    //add the field to the DB
    $db->Execute("ALTER TABLE `" . DB_PREFIX . "products` ADD `" . $field . "` " . $sql_type . ";");
    $messageStack->add($nice_field_name . " added", 'success');
}
