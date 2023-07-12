<?php 

$zc156 = (PROJECT_VERSION_MAJOR > 1 || (PROJECT_VERSION_MAJOR == 1 && substr(PROJECT_VERSION_MINOR, 0, 3) >= 5.6));

$filename = 'common.php';

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
          <div class="form-group">
              <?php echo zen_draw_label(TEXT_PRODUCTS_CONDITION, 'products_condition', 'class="col-sm-3 control-label"'); ?>
            <div class="col-sm-9 col-md-6">
                <?php echo zen_draw_input_field('products_condition', $pInfo->products_condition, 'class="form-control"'); ?>
            </div>
          </div>
<?php } else { ?>
          <tr>
            <td><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>
          <tr bgcolor="#DDEACC">
            <td class="main"><?php echo TEXT_PRODUCTS_CONDITION; ?></td>
            <td class="main" colspan="2"><?php echo zen_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . zen_draw_input_field('products_condition', $pInfo->products_condition); ?></td>
          </tr> 
          <tr>
            <td><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr> 
<?php } ?>