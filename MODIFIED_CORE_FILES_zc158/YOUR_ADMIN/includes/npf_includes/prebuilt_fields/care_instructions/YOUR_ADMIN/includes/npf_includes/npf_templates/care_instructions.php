<?php 

$zc156 = (PROJECT_VERSION_MAJOR > 1 || (PROJECT_VERSION_MAJOR == 1 && substr(PROJECT_VERSION_MINOR, 0, 3) >= 5.6));

$filename = 'care_instructions.php';

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
          <p class="col-sm-3 control-label"><?php if ($i == 0) echo TEXT_CARE_INSTRUCTIONS; ?></p>
        <div class="col-sm-9 col-md-6">
                    <div class="input-group">
              <span class="input-group-addon"><?php echo zen_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']); ?>&nbsp;</span>
                    <?php echo zen_draw_textarea_field('care_instructions[' . $languages[$i]['id'] . ']', 'soft', '100', '30', htmlspecialchars((isset($care_instructions[$languages[$i]['id']])) ? stripslashes($care_instructions[$languages[$i]['id']]) : zen_get_care_instructions($pInfo->products_id, $languages[$i]['id']), ENT_COMPAT, CHARSET, TRUE), 'class="editorHook form-control"'); ?>
                    <?php //echo zen_draw_textarea_field('care_instructions[' . $languages[$i]['id'] . ']', 'soft', '100%', '30', (isset($care_instructions[$languages[$i]['id']])) ? stripslashes($care_instructions[$languages[$i]['id']]) : zen_get_care_instructions($pInfo->products_id, $languages[$i]['id'])); ?>
                <br>
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
            <td class="main" valign="top"><?php if ($i == 0) echo TEXT_CARE_INSTRUCTIONS; ?></td>
            <td colspan="2">
              <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td class="main" width="25" valign="top"><?php echo zen_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']); ?>&nbsp;</td>
                  <td class="main" width="100%">
                    <?php echo zen_draw_textarea_field('care_instructions[' . $languages[$i]['id'] . ']', 'soft', '100%', '30', (isset($care_instructions[$languages[$i]['id']])) ? stripslashes($care_instructions[$languages[$i]['id']]) : zen_get_care_instructions($pInfo->products_id, $languages[$i]['id'])); ?>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
<?php
    }
?>
<?php } ?>