<?php 

$zc156 = (PROJECT_VERSION_MAJOR > 1 || (PROJECT_VERSION_MAJOR == 1 && substr(PROJECT_VERSION_MINOR, 0, 3) >= 5.6));


$filename = 'products_isbn.php';

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
              <?php echo zen_draw_label(TEXT_PRODUCTS_UPC, 'products_upc', 'class="col-sm-3 control-label"'); ?>
            <div class="col-sm-9 col-md-6">
                <?php echo zen_draw_input_field('products_upc', $pInfo->products_upc, 'class="form-control"'); ?>
            </div>
          </div>
          <div class="form-group">
              <?php echo zen_draw_label(TEXT_PRODUCTS_ISBN, 'products_isbn', 'class="col-sm-3 control-label"'); ?>
            <div class="col-sm-9 col-md-6">
                <?php echo zen_draw_input_field('products_isbn', $pInfo->products_isbn, 'class="form-control"'); ?>
            </div>
          </div>
          <div class="form-group">
              <?php echo zen_draw_label(TEXT_PRODUCTS_EAN, 'products_ean', 'class="col-sm-3 control-label"'); ?>
            <div class="col-sm-9 col-md-6">
                <?php echo zen_draw_input_field('products_ean', $pInfo->products_ean, 'class="form-control"'); ?>
            </div>
          </div>
          <div class="form-group">
              <?php echo zen_draw_label(TEXT_PRODUCTS_ASIN, 'products_asin', 'class="col-sm-3 control-label"'); ?>
            <div class="col-sm-9 col-md-6">
                <?php echo zen_draw_input_field('products_asin', $pInfo->products_asin, 'class="form-control"'); ?>
            </div>
          </div>
<?php } else { ?>
          <tr>
            <td colspan="2"><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>          
          <tr bgcolor="#DDEACC">
            <td class="main"><?php echo TEXT_PRODUCTS_UPC; ?></td>
            <td class="main"><?php echo zen_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . zen_draw_input_field('products_upc', $pInfo->products_upc, zen_set_field_length(TABLE_PRODUCTS, 'products_upc')); ?></td>
          </tr>
          <tr bgcolor="#DDEACC">
            <td class="main"><?php echo TEXT_PRODUCTS_ISBN; ?></td>
            <td class="main"><?php echo zen_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . zen_draw_input_field('products_isbn', $pInfo->products_isbn, zen_set_field_length(TABLE_PRODUCTS, 'products_isbn')); ?></td>
          </tr>
          <tr bgcolor="#DDEACC">
            <td class="main"><?php echo TEXT_PRODUCTS_EAN; ?></td>
            <td class="main"><?php echo zen_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . zen_draw_input_field('products_ean', $pInfo->products_ean, zen_set_field_length(TABLE_PRODUCTS, 'products_ean')); ?></td>
          </tr>
          <tr bgcolor="#DDEACC">
            <td class="main"><?php echo TEXT_PRODUCTS_ASIN; ?></td>
            <td class="main"><?php echo zen_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . zen_draw_input_field('products_asin', $pInfo->products_asin, zen_set_field_length(TABLE_PRODUCTS, 'products_asin')); ?></td>
          </tr>
          <tr>
            <td colspan="2"><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>
<?php } ?>