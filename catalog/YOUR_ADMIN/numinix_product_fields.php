<?php
/**
 * @package admin
 * @copyright Copyright 2003-2010 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: numinix_product_fields.php 2014-0919 1:05PM CDT bislewl $
 */

require('includes/application_top.php');
$add_npf_field = zen_db_prepare_input($_POST['add_npf_field']);
$add_custom_npf_field = zen_db_prepare_input($_POST['add_custom_npf_field']);
$add_custom_npf_field_name = zen_db_prepare_input($_POST['add_custom_npf_field_name']);
$add_custom_npf_field_type = zen_db_prepare_input($_POST['add_custom_npf_field_type']);
$add_custom_npf_field_length = zen_db_prepare_input($_POST['add_custom_npf_field_length']);
$file_posted = basename($_FILES["file_download"]);

if($add_npf_field != ''){
    $field = $add_npf_field;
    
    //move files
    if (!npf_add_prebuilt_fields($field)) {
      $messageStack->add('The selected field was unable to be installed due to insufficient server permissions, please contact your host.','error');
    } else {
      //execute SQL Patch
      $query_string = file_get_contents(NPF_INCLUDES_PREBUILT_FOLDER.$field.'/install.sql');
      npf_sql_patch($query_string);

      $messageStack->add(ucwords(strtolower(str_replace("_", " ", $field)))." added", 'success');
    }
}
if($add_custom_npf_field == "Y"){
    if($add_custom_npf_field_length  == ''){
        $add_custom_npf_field_length = '300';
    }
   add_custom_field($add_custom_npf_field_name, $add_custom_npf_field_type, $add_custom_npf_field_length);
}



      $current_product_fields = array();
      $tableFields = $db->metaColumns(TABLE_PRODUCTS);
      $columnName = strtoupper($columnName);
      //loop to traverse tableFields result set
      foreach($tableFields as $key=>$value) 
      {    
          $current_product_fields[] = strtolower($key);
      }
      $pdtableFields = $db->metaColumns(TABLE_PRODUCTS_DESCRIPTION);
      $pdcolumnName = strtoupper($pdcolumnName);
      //loop to traverse tableFields result set
      foreach($pdtableFields as $key=>$value) 
      {    
          $current_product_fields[] = strtolower($key);
      }
      sort($current_product_fields);
      
      

$dirs = scandir(NPF_INCLUDES_PREBUILT_FOLDER);

$prebuilt_fields = array();
foreach ($dirs as $dir) {
    if ($dir != '.' && $dir != '..') {
        if (is_dir(NPF_INCLUDES_PREBUILT_FOLDER . '/' . $dir) && !in_array($dir, $current_product_fields)) {
            $prebuilt_fields[] = $dir;
        }
    }
}
sort($prebuilt_fields);

?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?> - Numinix Product Fields</title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
<script language="javascript" src="includes/menu.js"></script>
<script language="javascript" src="includes/general.js"></script>

<script type="text/javascript">
  <!--
  function init()
  {
    cssjsmenu('navbar');
    if (document.getElementById)
    {
      var kill = document.getElementById('hoverJS');
      kill.disabled = true;
    }
  }
  // -->
</script>
</head>
<body onLoad="init()">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
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
                                        foreach($prebuilt_fields as $prebuilt_ready_field){
                                            echo zen_draw_form('npf_fields',NUMINIX_PRODUCT_FIELDS_FILENAME);
                                            echo zen_draw_hidden_field('add_npf_field',$prebuilt_ready_field);
                                            $nice_name_prebuilt_field = ucwords(strtolower(str_replace("_", " ", $prebuilt_ready_field)));
                                            echo zen_draw_input_field('submit', 'Add Field', '', false, 'submit');
                                            echo $nice_name_prebuilt_field." ";
                                            echo '</form><br/>';
                                        }
                                        ?>
                                    </td>
                                    <td align="right">
                                        <?php
                                        foreach($current_product_fields as $current_product_field){
                                            echo $current_product_field.'<br/>';
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
                            echo zen_draw_form('custom_npf_fields',NUMINIX_PRODUCT_FIELDS_FILENAME);
                            echo zen_draw_hidden_field('add_custom_npf_field',"Y");
                            echo " Field Name:".zen_draw_input_field('add_custom_npf_field_name');
                            $pull_down_array[] = array( 'id' => 'text',
                                                        'text' => 'Text');
                            $pull_down_array[] = array( 'id' => 'checkbox',
                                                        'text' => 'Checkbox');
                            $pull_down_array[] = array( 'id' => 'file',
                                                        'text' => 'File');
                            echo " Type:".zen_draw_pull_down_menu('add_custom_npf_field_type',$pull_down_array);
                            //echo zen_draw_input_field('add_custom_npf_field_length','300');
                            echo "  ".zen_draw_input_field('submit', 'Add Field', '', false, 'submit');
                            echo '</form><br/>';
                      ?>
                      <hr/>
                  </td>
                </tr>
			</table>
		</td>
	</tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php');
