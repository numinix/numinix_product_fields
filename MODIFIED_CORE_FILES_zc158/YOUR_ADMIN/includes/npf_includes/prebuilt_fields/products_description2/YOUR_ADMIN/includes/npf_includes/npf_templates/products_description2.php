<?php 

$zc156 = (PROJECT_VERSION_MAJOR > 1 || (PROJECT_VERSION_MAJOR == 1 && substr(PROJECT_VERSION_MINOR, 0, 3) >= 5.6));


$filename = 'products_description2.php';

$path1 = 'languages/english/npf_definitions/';
$path2 = 'languages/english/npf_definitions/lang.';
$opt1 = DIR_WS_INCLUDES.$path1.$filename;
$opt2 = DIR_WS_INCLUDES.$path2.$filename;
$defines = include DIR_WS_INCLUDES. (file_exists($opt2)) ? $opt2 : $opt1 .$filename;
foreach($defines as $key=>$value){
  if(!defined($key)){
    define($key, $value);
  }
}

if($zc156){ ?>
<?php
    for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
?>
     <div class="form-group">
       <div class="col-sm-9 col-md-6">
        <table>
          <tr>
            <td class="main" valign="top"><?php if ($i == 0) echo TEXT_PRODUCTS_DESCRIPTION2; ?></td>
            <td colspan="2">
              <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td class="main" width="25" valign="top"><?php echo zen_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']); ?>&nbsp;</td>
                  <td class="main" width="100%">
        <?php if ($_SESSION['html_editor_preference_status']=="FCKEDITOR") {
                $oFCKeditor = new FCKeditor('products_description2[' . $languages[$i]['id'] . ']') ;
                $oFCKeditor->Value = (isset($products_description2[$languages[$i]['id']])) ? stripslashes($products_description2[$languages[$i]['id']]) : zen_get_products_description2($pInfo->products_id, $languages[$i]['id']) ;
                $oFCKeditor->Width  = '99%' ;
                $oFCKeditor->Height = '350' ;
//                $oFCKeditor->Config['ToolbarLocation'] = 'Out:xToolbar' ;
//                $oFCKeditor->Create() ;
                $output = $oFCKeditor->CreateHtml() ;  echo $output;
          } else { // using HTMLAREA or just raw "source"

            echo zen_draw_textarea_field('products_description2[' . $languages[$i]['id'] . ']', 'soft', '100%', '30', (isset($products_description2[$languages[$i]['id']])) ? stripslashes($products_description2[$languages[$i]['id']]) : zen_get_products_description2($pInfo->products_id, $languages[$i]['id'])); //,'id="'.'products_description' . $languages[$i]['id'] . '"');
          } ?>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
        </div>
      </div>
<?php
    }
?>
<?php } else { ?>
<?php
    for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
?>
          <tr>
            <td class="main" valign="top"><?php if ($i == 0) echo TEXT_PRODUCTS_DESCRIPTION2; ?></td>
            <td colspan="2">
              <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td class="main" width="25" valign="top"><?php echo zen_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']); ?>&nbsp;</td>
                  <td class="main" width="100%">
        <?php if ($_SESSION['html_editor_preference_status']=="FCKEDITOR") {
                $oFCKeditor = new FCKeditor('products_description2[' . $languages[$i]['id'] . ']') ;
                $oFCKeditor->Value = (isset($products_description2[$languages[$i]['id']])) ? stripslashes($products_description2[$languages[$i]['id']]) : zen_get_products_description2($pInfo->products_id, $languages[$i]['id']) ;
                $oFCKeditor->Width  = '99%' ;
                $oFCKeditor->Height = '350' ;
//                $oFCKeditor->Config['ToolbarLocation'] = 'Out:xToolbar' ;
//                $oFCKeditor->Create() ;
                $output = $oFCKeditor->CreateHtml() ;  echo $output;
          } else { // using HTMLAREA or just raw "source"

            echo zen_draw_textarea_field('products_description2[' . $languages[$i]['id'] . ']', 'soft', '100%', '30', (isset($products_description2[$languages[$i]['id']])) ? stripslashes($products_description2[$languages[$i]['id']]) : zen_get_products_description2($pInfo->products_id, $languages[$i]['id'])); //,'id="'.'products_description' . $languages[$i]['id'] . '"');
          } ?>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
<?php
    }
?>
<?php } ?>