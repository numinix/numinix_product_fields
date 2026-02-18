<?php

function dirList($directory)
{
    // create an array to hold directory list
    $results = [];

    if (is_dir($directory)) {
        // create a handler for the directory
        if ($handler = opendir($directory)) {
            // keep going until all files in directory have been read
            while ($file = readdir($handler)) {
                // if $file isn't this directory or its parent,
                // add it to the results array
                if ($file !== '.' && $file !== '..') {
                    $results[] = $file;
                }
            }
            asort($results);
            // tidy up: close the handler
            closedir($handler);
        }
    }

    return $results;
}


function zen_get_field_from_table_products_description($product_id, $language_id, $field_name)
{
    global $db;
    $field_name = zen_db_input($field_name);
    $product = $db->Execute(
        "SELECT `" . $field_name . "` FROM " . TABLE_PRODUCTS_DESCRIPTION . " WHERE products_id = " . (int)$product_id . " AND language_id = " . (int)$language_id
    );
    return $product->fields[$field_name];
}

function npf_add_prebuilt_fields($field)
{

    $lang_definitions_file = 'languages/english/npf_definitions/' . $field . '.php';

    $array_of_files = [
        $lang_definitions_file,
        'functions/extra_functions/' . $field . '.php',
        'npf_includes/npf_custom_execute/' . $field . '.php',
        'npf_includes/npf_description_sql_array/' . $field . '.php',
        'npf_includes/npf_modules/' . $field . '.php',
        'npf_includes/npf_process/' . $field . '.php',
        'npf_includes/npf_sql/' . $field . '.php',
        'npf_includes/npf_sql_array/' . $field . '.php',
        'npf_includes/npf_templates/' . $field . '.php',
        'npf_includes/npf_preview/' . $field . '.php',
        'npf_includes/npf_preview_info/' . $field . '.php',
    ];
    $npf_copy_failed_count = 0;
    foreach ($array_of_files as $possible_file) {
        if (!npf_copy_file($field, $possible_file)) {
            $npf_copy_failed_count++;
        }
    }
    if ($npf_copy_failed_count == count($array_of_files)) { // if none of the files gets copied over, something is wrong for sure
        return false;
    }
    return true;
}

function npf_copy_file($field, $folder)
{
    if (file_exists(DIR_FS_ADMIN . NPF_INCLUDES_PREBUILT_FOLDER . $field . '/YOUR_ADMIN/includes/' . $folder)) {
        $contents = file_get_contents(DIR_FS_ADMIN . NPF_INCLUDES_PREBUILT_FOLDER . $field . '/YOUR_ADMIN/includes/' . $folder);
        $copy_file_result = file_put_contents(DIR_FS_ADMIN . DIR_WS_INCLUDES . $folder, $contents);
        if ($copy_file_result == 0 || $copy_file_result == false) {
            return false;
        }
        return true;
    } else {
        return false;
    }
}

function npf_sql_patch($string)
{
    global $sniffer, $db;
    $string = str_replace("`", "", $string);
    $string = str_replace(" products ", " " . DB_PREFIX . "products ", $string);
    $string = str_replace(" product_type_layout ", " " . DB_PREFIX . "product_type_layout ", $string);
    $string = str_replace(" products_description ", " " . DB_PREFIX . "products_description ", $string);
    $query_array = explode(';', $string);
    foreach ($query_array as $query) {
        if (strlen($query) > 5) {
            $db->Execute($query . ';');
        }
    }
}

if (!function_exists('npf_field_value')) {

    function npf_field_value($id, $field)
    {
        global $db;
        $product = $db->Execute("SELECT * FROM " . TABLE_PRODUCTS . " WHERE products_id=" . (int) $id . " LIMIT 1");
        return $product->fields[$field];
    }

}

function zen_npf_file($npf_file)
{
    if (!empty($npf_file) && (file_exists(DIR_FS_CATALOG . $npf_file))) {
        $npf_file = '<a href="' . HTTPS_CATALOG_SERVER . DIR_WS_HTTPS_CATALOG . $npf_file . '" target="_blank" rel="noopener noreferrer">' . $npf_file . '</a>';
    } else {
        $npf_file = "FILE IS MISSING";
    }

    return $npf_file;
}

function add_custom_field($field_name, $type, $length = '300')
{
    global $db, $messageStack;
    $field = str_replace(' ', '_', strtolower($field_name));
    $nice_field_name = ucwords(strtolower(str_replace('_', ' ', $field)));
    global $sniffer;
    if ($sniffer->field_exists(TABLE_PRODUCTS, $field)) {
        $messageStack->add('ERROR!! Product field ' . $field . ' already exists', 'caution');
        return;
    }
    $zc156 = (PROJECT_VERSION_MAJOR > 1 || (PROJECT_VERSION_MAJOR == 1 && substr(PROJECT_VERSION_MINOR, 0, 3) >= 5.6));
    $lang_defines = strtoupper($field);
    switch ($type) {
        // general file upload field. show URL instead of image
        case "file":
            $sql_type = "varchar(" . $length . ") DEFAULT NULL";
            $string_input_field = "<hr>
<h2><?php echo TEXT_" . $lang_defines . "; ?></h2>
<?php
if (!empty(\$pInfo->" . $field . ")) { ?>
    <div class=\"form-group\">
        <div class=\"col-sm-offset-3 col-sm-9 col-md-6\">
            <?php echo zen_npf_file(\$pInfo->" . $field . "); ?>
        </div>
    </div>
    <div class=\"form-group\">
        <p class=\"col-sm-3 control-label\"><?php echo \"Remove File? Note: Removes file from product (file is NOT deleted/removed from server):\"; ?></p>
        <div class=\"col-sm-9 col-md-6\">
            <label class=\"radio-inline\"><?php echo zen_draw_radio_field('" . $field . "_file_delete', '0', true) . TABLE_HEADING_NO; ?></label>
            <label class=\"radio-inline\"><?php echo zen_draw_radio_field('" . $field . "_file_delete', '1', false) . TABLE_HEADING_YES; ?></label>
        </div>
    </div>
<?php }
?>
<div class=\"form-group\">
    <?php echo zen_draw_label('Edit File:', '" . $field . "', 'class=\"col-sm-3 control-label\"'); ?>
    <div class=\"col-sm-9 col-md-9 col-lg-6\">
        <?php echo zen_draw_file_field('" . $field . "', '', 'class=\"form-control\" id=\"" . $field . "\"'); ?>
        <?php echo zen_draw_hidden_field('" . $field . "_previous_file', \$pInfo->" . $field . " ?? ''); ?>
    </div>
</div>
<div class=\"form-group\">
    <p class=\"col-sm-3 control-label\"><?php echo \"Overwrite Existing File on Server?\"; ?></p>
    <div class=\"col-sm-9 col-md-9 col-lg-6\">
        <label class=\"radio-inline\"><?php echo zen_draw_radio_field('" . $field . "_overwrite', '0', false) . TABLE_HEADING_NO; ?></label>
        <label class=\"radio-inline\"><?php echo zen_draw_radio_field('" . $field . "_overwrite', '1', true) . TABLE_HEADING_YES; ?></label>
    </div>
</div>
<div class=\"form-group\">
    <?php echo zen_draw_label(\"Or, use an existing file from server, filename:\", '" . $field . "_file_manual', 'class=\"col-sm-3 control-label\"'); ?>
    <div class=\"col-sm-9 col-md-9 col-lg-6\">
        <?php echo zen_draw_input_field('" . $field . "_file_manual', '', 'class=\"form-control\" id=\"" . $field . "_file_manual\"'); ?>
    </div>
</div>
<hr>";
            break;
        case "checkbox":
            /*
                Checkbox doesn't go into form when its not checked.
                Hidden fild will fill the form with false value when Checkbox not present (unchecked).
                Checkbox will overwrite hidden field when its set to true.
            */
            $string_input_field = "<div class=\"form-group\">
    <?php echo zen_draw_label(TEXT_" . $lang_defines . ", '" . $field . "', 'class=\"col-sm-3 control-label\"'); ?>
    <div class=\"col-sm-9 col-md-6\">
        <?php echo zen_draw_checkbox_field('" . $field . "', 1, (\$pInfo->" . $field . ") ? true : false, '', 'id=\"" . $field . "\"'); ?>
    </div>
</div>";
            $sql_type = "tinyint(1) NOT NULL DEFAULT 0";
            break;
        case "text":
        default:
            $sql_type = "varchar(" . $length . ") DEFAULT NULL";
            $string_input_field = "<div class=\"form-group\">
    <?php echo zen_draw_label(TEXT_" . $lang_defines . ", '" . $field . "', 'class=\"col-sm-3 control-label\"'); ?>
    <div class=\"col-sm-9 col-md-6\">
        <?php echo zen_draw_input_field('" . $field . "', (\$pInfo->" . $field . "), 'class=\"form-control\" id=\"" . $field . "\"'); ?>
    </div>
</div>";
            break;
    }
    //files
    $admin_start_file = "<?php  

/**
 * File Generated by Numinix Product Fields
 * @package admin
 * @copyright Copyright 2003-2025 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 */

if (!defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
}
";

    $string_npf_lang_file = "
\$define = [ 'TEXT_" . $lang_defines . "' => '" . $nice_field_name . ": ' ];
\$zc158 = (PROJECT_VERSION_MAJOR > 1 || (PROJECT_VERSION_MAJOR == 1 && substr(PROJECT_VERSION_MINOR, 0, 3) >= '5.8'));
if (\$zc158) {
    return \$define;
} else {
    nmx_create_defines(\$define);
}
// eof";
    file_put_contents(NPF_DEFINITIONS_FOLDER . $field . '.php', $admin_start_file . $string_npf_lang_file);

    $string_npf_sql_file = "
\$parameters['" . $field . "'] = '';
\$npf_fields .= ', p." . $field . "'; 
// eof";
    file_put_contents(NPF_INCLUDES_SQL_FOLDER . $field . '.php', $admin_start_file . $string_npf_sql_file);

    $string_npf_sql_array_file = "
if (isset(\$_POST['" . $field . "'])) {
    \$sql_data_array['" . $field . "'] = zen_db_prepare_input(\$_POST['" . $field . "']);
}";
    if ($type == 'file') {
    $string_npf_sql_array_file .= "
if (isset(\$_POST['" . $field . "_file_delete']) && \$_POST['" . $field . "_file_delete'] == 1) {
    \$sql_data_array['" . $field . "'] = '';
}";
    }
    file_put_contents(NPF_INCLUDES_SQL_ARRAY_FOLDER . $field . '.php', $admin_start_file . $string_npf_sql_array_file);

    $string_npf_templates_file = $string_input_field;
    file_put_contents(NPF_INCLUDES_TEMPLATES_FOLDER . $field . '.php', $string_npf_templates_file);

    if ($type == 'file') {
        $process_string = "";
        file_put_contents(NPF_INCLUDES_PROCESSING_FOLDER . $field . '.php', $admin_start_file . $process_string);
        $preview_string = "
// upload file, if submitted
if (!isset(\$_GET['read']) || \$_GET['read'] !== 'only') {
    \$products_" . $field . " = new upload('" . $field . "');
    \$products_" . $field . "->set_destination(DIR_FS_CATALOG . NPF_UPLOAD_FOLDER . '/');
    if (\$products_" . $field . "->parse() && \$products_" . $field . "->save(isset(\$_POST['" . $field . "_overwrite']) ? \$_POST['" . $field . "_overwrite'] : false)) {
        \$products_" . $field . "_name = NPF_UPLOAD_FOLDER . '/' . \$products_" . $field . "->filename;
    } else {
        \$products_" . $field . "_name = (isset(\$_POST['" . $field . "_previous_file']) ? \$_POST['" . $field . "_previous_file'] : '');
    }
}
if (\$_POST['" . $field . "_file_manual'] != '') {
    \$products_" . $field . "_name = NPF_UPLOAD_FOLDER . '/' . \$_POST['" . $field . "_file_manual'];
}
\$_POST['" . $field . "'] = \$products_" . $field . "_name;

";
        file_put_contents(NPF_INCLUDES_PREVIEW_FOLDER . $field . '.php', $admin_start_file . $preview_string);
        $preview_info_string = '';
        file_put_contents(NPF_INCLUDES_PREVIEW_INFO_FOLDER . $field . '.php', $admin_start_file . $preview_info_string);
    }
    // add the field to the DB
    $db->Execute("ALTER TABLE `" . DB_PREFIX . "products` ADD `" . $field . "` " . $sql_type . ";");
    $messageStack->add($nice_field_name . ' added', 'success');
}

// bof NX-2511: Program delete feature in NPF
function delete_custom_field($field)
{
    global $sniffer, $db, $messageStack;
    (file_exists(NPF_DEFINITIONS_FOLDER . $field . ".php")) ? unlink(NPF_DEFINITIONS_FOLDER . $field . ".php") : false;
    (file_exists(NPF_INCLUDES_SQL_FOLDER . $field . ".php")) ? unlink(NPF_INCLUDES_SQL_FOLDER . $field . ".php") : false;
    (file_exists(NPF_INCLUDES_MODULES_FOLDER . $field . ".php")) ? unlink(NPF_INCLUDES_MODULES_FOLDER . $field . ".php") : false;
    (file_exists(NPF_INCLUDES_DESCRIPTION_SQL_ARRAY_FOLDER . $field . ".php")) ? unlink(NPF_INCLUDES_DESCRIPTION_SQL_ARRAY_FOLDER . $field . ".php") : false;
    (file_exists(NPF_INCLUDES_SQL_ARRAY_FOLDER . $field . ".php")) ? unlink(NPF_INCLUDES_SQL_ARRAY_FOLDER . $field . ".php") : false;
    (file_exists(NPF_INCLUDES_TEMPLATES_FOLDER . $field . ".php")) ? unlink(NPF_INCLUDES_TEMPLATES_FOLDER . $field . ".php") : false;
    (file_exists(NPF_INCLUDES_PROCESSING_FOLDER . $field . ".php")) ? unlink(NPF_INCLUDES_PROCESSING_FOLDER . $field . ".php") : false;
    (file_exists(NPF_INCLUDES_PREVIEW_FOLDER . $field . ".php")) ? unlink(NPF_INCLUDES_PREVIEW_FOLDER . $field . ".php") : false;
    (file_exists(NPF_INCLUDES_PREVIEW_INFO_FOLDER . $field . ".php")) ? unlink(NPF_INCLUDES_PREVIEW_INFO_FOLDER . $field . ".php") : false;
    ($sniffer->field_exists(TABLE_PRODUCTS, $field)) ? $db->Execute("ALTER TABLE `" . DB_PREFIX . "products` DROP `" . $field . "`;") : false;
    if (file_exists(NPF_INCLUDES_PREBUILT_FOLDER . $field . '/uninstall.sql')) {
        $query_string = file_get_contents(NPF_INCLUDES_PREBUILT_FOLDER . $field . '/uninstall.sql');
        npf_sql_patch($query_string);
    }
    $messageStack->add($field . ' deleted', 'success');
}
// eof NX-2511: Program delete feature in NPF
