<?php
/**
 * @package admin
 * @copyright Copyright 2003-2010 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: numinix_product_fields.php 2014-0919 1:05PM CDT bislewl $
 */

require 'includes/application_top.php';

$add_npf_field = zen_db_prepare_input($_POST['add_npf_field'] ?? '');
$add_custom_npf_field = zen_db_prepare_input($_POST['add_custom_npf_field'] ?? '');
$add_custom_npf_field_name = zen_db_prepare_input($_POST['add_custom_npf_field_name'] ?? '');
$add_custom_npf_field_type = zen_db_prepare_input($_POST['add_custom_npf_field_type'] ?? '');
$add_custom_npf_field_length = zen_db_prepare_input($_POST['add_custom_npf_field_length'] ?? '');
$file_posted = (isset($_FILES['file_download']) && $_FILES['file_download'] !== null) ? basename($_FILES['file_download']) : '';
// bof NX-2511: Program delete feature in NPF
$delete_custom_npf_field = zen_db_prepare_input($_POST['delete_custom_npf_field'] ?? '');
$delete_custom_npf_field_name = zen_db_prepare_input($_POST['delete_custom_npf_field_name'] ?? '');
// eof NX-2511: Program delete feature in NPF

if ($add_npf_field !== '') {
  $field = $add_npf_field;

  // move files
  if (!npf_add_prebuilt_fields($field)) {
    $messageStack->add('The selected field was unable to be installed due to insufficient server permissions, please contact your host.', 'error');
  } else {
    // execute SQL Patch
    $query_string = file_get_contents(NPF_INCLUDES_PREBUILT_FOLDER . $field . '/install.sql');
    npf_sql_patch($query_string);

    $messageStack->add(ucwords(strtolower(str_replace('_', ' ', $field))) . ' added', 'success');
  }
}

if ($add_custom_npf_field === 'Y') {
  if ($add_custom_npf_field_length === '') {
    $add_custom_npf_field_length = '300';
  }
  add_custom_field($add_custom_npf_field_name, $add_custom_npf_field_type, $add_custom_npf_field_length);
}

// bof NX-2511: Program delete feature in NPF
if ($delete_custom_npf_field === 'Y') {
  delete_custom_field($delete_custom_npf_field_name);
}
// eof NX-2511: Program delete feature in NPF

$current_product_fields = [];
$tableFields = $db->metaColumns(TABLE_PRODUCTS);
$columnName = (isset($columnName) && $columnName !== null) ? strtoupper($columnName) : '';
// loop to traverse tableFields result set
foreach ($tableFields as $key => $value) {
  $current_product_fields[] = strtolower($key);
}

$pdtableFields = $db->metaColumns(TABLE_PRODUCTS_DESCRIPTION);
$pdcolumnName = (isset($pdcolumnName) && $pdcolumnName !== null) ? strtoupper($pdcolumnName) : '';
// loop to traverse tableFields result set
foreach ($pdtableFields as $key => $value) {
  $current_product_fields[] = strtolower($key);
}
sort($current_product_fields);

$dirs = scandir(NPF_INCLUDES_PREBUILT_FOLDER);

$prebuilt_fields = [];
foreach ($dirs as $dir) {
  if ($dir !== '.' && $dir !== '..') {
    if (is_dir(NPF_INCLUDES_PREBUILT_FOLDER . '/' . $dir) && !in_array($dir, $current_product_fields)) {
      $prebuilt_fields[] = $dir;
    }
  }
}
sort($prebuilt_fields);

$dirList = dirList(NPF_INCLUDES_SQL_ARRAY_FOLDER);
foreach ($dirList as $file) {
  include NPF_INCLUDES_SQL_ARRAY_FOLDER . $file;
}
?>
<!doctype html>
<html <?php echo HTML_PARAMS; ?>>
  <?php
  $zcVersion = (PROJECT_VERSION_MAJOR > 1);
  if($zcVersion) {
    ?>
    <head>
      <?php require DIR_WS_INCLUDES . 'admin_html_head.php'; ?>
    </head>
    <body>
    <?php
  } else {
    ?>
    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
      <title><?php echo TITLE; ?> - Numinix Product Fields</title>
      <link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
      <link rel="stylesheet" type="text/css" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
      <script language="javascript" src="includes/menu.js"></script>
      <script language="javascript" src="includes/general.js"></script>
      <script type="text/javascript">
        function init()
        {
          cssjsmenu('navbar');
          if (document.getElementById)
          {
            var kill = document.getElementById('hoverJS');
            kill.disabled = true;
          }
        }
      </script>
    </head>
    <body onLoad="init()">
    <?php
  }
  ?>
    <!-- header //-->
    <?php require DIR_WS_INCLUDES . 'header.php'; ?>
    <!-- header_eof //-->
    <table border="0" width="100%" cellspacing="2" cellpadding="2">
      <tr>
        <td width="100%" valign="top">
          <table border="0" width="100%" cellspacing="0" cellpadding="0">
            <tr>
              <td>
                <table border="0" width="100%" cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="pageHeading">Numinix Product Fields</td>
                    <td class="pageHeading" align="right"><img src="images/pixel_trans.gif" border="0" alt="" width="57" height="40"></td>
                  </tr>
                  <tr>
                    <td>
                      <table width="700px">
                        <tr>
                          <th align="left">Available Fields</th>
                          <th align="right">Current Product Fields</th>
                        </tr>
                        <tr>
                          <td align="left">
                            <?php
                            foreach ($prebuilt_fields as $prebuilt_ready_field) {
                              echo zen_draw_form('npf_fields', NUMINIX_PRODUCT_FIELDS_FILENAME);
                              echo zen_draw_hidden_field('add_npf_field', $prebuilt_ready_field);
                              $nice_name_prebuilt_field = ucwords(strtolower(str_replace('_', ' ', $prebuilt_ready_field)));
                              echo zen_draw_input_field('submit', 'Add Field', '', false, 'submit');
                              echo $nice_name_prebuilt_field . ' ';
                              echo '</form><br/>';
                            }
                            ?>
                          </td>
                          <td align="right">
                            <?php
                            foreach ($current_product_fields as $current_product_field) {
                              if (isset($sql_data_array) && array_key_exists($current_product_field, $sql_data_array)) {
                                echo $current_product_field . ' (added by Numinix Fields)<br/>';
                              } else {
                                echo $current_product_field . '<br/>';
                              }
                            }
                            ?>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
                <br/>
                <hr/>
                <br/>
                <br/>
                <h2>Add your own Custom Field</h2>
                <br/>
                <?php
                echo zen_draw_form('custom_npf_fields', NUMINIX_PRODUCT_FIELDS_FILENAME);
                echo zen_draw_hidden_field('add_custom_npf_field', 'Y');
                echo ' Field Name:' . zen_draw_input_field('add_custom_npf_field_name');
                $pull_down_array[] = ['id' => 'text', 'text' => 'Text'];
                $pull_down_array[] = ['id' => 'checkbox', 'text' => 'Checkbox'];
                $pull_down_array[] = ['id' => 'file', 'text' => 'File'];
                $pull_down_array[] = ['id' => 'video', 'text' => 'Video Upload'];
                echo ' Type:' . zen_draw_pull_down_menu('add_custom_npf_field_type', $pull_down_array);
                // echo zen_draw_input_field('add_custom_npf_field_length', '300');
                echo '  ' . zen_draw_input_field('submit', 'Add Field', '', false, 'submit');
                echo '</form><br/>';
                ?>
                <hr/>
                <h2>Delete a Custom Field</h2>
                <br/>
                <?php
                // bof NX-2511: Program delete feature in NPF
                $pull_down_array = [];
                $npf_definitions_dir = dirList(NPF_DEFINITIONS_FOLDER);
                foreach ($npf_definitions_dir as $file) {
                  if ($file !== '.htaccess') {
                    $field = str_replace('.php', '', $file);
                    $field = str_replace('lang.', '', $field);
                    $pull_down_array[] = ['id' => $field, 'text' => $field];
                  }
                }
                echo zen_draw_form('custom_npf_fields2', NUMINIX_PRODUCT_FIELDS_FILENAME, 'delete');
                echo zen_draw_hidden_field('delete_custom_npf_field', 'Y');
                echo ' Field Name:' . zen_draw_pull_down_menu('delete_custom_npf_field_name', $pull_down_array);
                echo '  ' . zen_draw_input_field('delete', 'Delete Field', 'onclick="return confirm(\'Are you sure you want to delete this field?\');"', false, 'submit');
                echo '</form><br/>';
                // eof NX-2511: Program delete feature in NPF
                ?>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
    <!-- body_eof //-->

    <!-- footer //-->
    <?php require DIR_WS_INCLUDES . 'footer.php'; ?>
    <!-- footer_eof //-->
  </body>
</html>
<?php require DIR_WS_INCLUDES . 'application_bottom.php';
