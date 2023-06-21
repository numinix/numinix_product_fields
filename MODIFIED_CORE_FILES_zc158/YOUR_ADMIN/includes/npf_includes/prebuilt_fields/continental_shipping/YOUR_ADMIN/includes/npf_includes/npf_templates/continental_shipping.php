<?php 

$zc156 = (PROJECT_VERSION_MAJOR > 1 || (PROJECT_VERSION_MAJOR == 1 && substr(PROJECT_VERSION_MINOR, 0, 3) >= 5.6));

$filename = 'continental_shipping.php';

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
              <?php echo "<strong>" . TEXT_PRODUCTS_ASA_SHIPPING . "</strong>"; ?>
            <div class="col-sm-9 col-md-6">
            </div>
          </div>
          <div class="form-group">
              <?php echo zen_draw_label(TEXT_PRODUCTS_SH_NA, 'products_sh_na', 'class="col-sm-3 control-label"'); ?>
            <div class="col-sm-9 col-md-6">
                <?php echo zen_draw_input_field('products_sh_na', $pInfo->products_sh_na, 'class="form-control"'); ?>
            </div>
          </div>
          <div class="form-group">
              <?php echo zen_draw_label(TEXT_PRODUCTS_SH_SA, 'products_sh_sa', 'class="col-sm-3 control-label"'); ?>
            <div class="col-sm-9 col-md-6">
                <?php echo zen_draw_input_field('products_sh_sa', $pInfo->products_sh_sa, 'class="form-control"'); ?>
            </div>
          </div>
          <div class="form-group">
              <?php echo zen_draw_label(TEXT_PRODUCTS_SH_EU, 'products_sh_eu', 'class="col-sm-3 control-label"'); ?>
            <div class="col-sm-9 col-md-6">
                <?php echo zen_draw_input_field('products_sh_eu', $pInfo->products_sh_eu, 'class="form-control"'); ?>
            </div>
          </div>
          <div class="form-group">
              <?php echo zen_draw_label(TEXT_PRODUCTS_SH_AS, 'products_sh_as', 'class="col-sm-3 control-label"'); ?>
            <div class="col-sm-9 col-md-6">
                <?php echo zen_draw_input_field('products_sh_as', $pInfo->products_sh_as, 'class="form-control"'); ?>
            </div>
          </div>
          <div class="form-group">
              <?php echo zen_draw_label(TEXT_PRODUCTS_SH_AF, 'products_sh_af', 'class="col-sm-3 control-label"'); ?>
            <div class="col-sm-9 col-md-6">
                <?php echo zen_draw_input_field('products_sh_af', $pInfo->products_sh_af, 'class="form-control"'); ?>
            </div>
          </div>
          <div class="form-group">
              <?php echo zen_draw_label(TEXT_PRODUCTS_SH_AU, 'products_sh_au', 'class="col-sm-3 control-label"'); ?>
            <div class="col-sm-9 col-md-6">
                <?php echo zen_draw_input_field('products_sh_au', $pInfo->products_sh_au, 'class="form-control"'); ?>
            </div>
          </div>
<?php } else { ?>
          <tr>
            <td colspan="3"><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>          
          <tr bgcolor="#DDEACC">
            <td class="main"><?php echo "<strong>" . TEXT_PRODUCTS_ASA_SHIPPING . "</strong>"; ?></td>
            <td></td>
          </tr>
          <tr bgcolor="#DDEACC">
            <td class="main"><?php echo TEXT_PRODUCTS_SH_NA; ?></td>
            <td class="main"><?php echo zen_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . zen_draw_input_field('products_sh_na', $pInfo->products_sh_na); ?></td>
          </tr>
          <tr bgcolor="#DDEACC">
            <td class="main"><?php echo TEXT_PRODUCTS_SH_SA; ?></td>
            <td class="main"><?php echo zen_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . zen_draw_input_field('products_sh_sa', $pInfo->products_sh_sa); ?></td>
          </tr>
          <tr bgcolor="#DDEACC">
            <td class="main"><?php echo TEXT_PRODUCTS_SH_EU; ?></td>
            <td class="main"><?php echo zen_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . zen_draw_input_field('products_sh_eu', $pInfo->products_sh_eu); ?></td>
          </tr>
          <tr bgcolor="#DDEACC">
            <td class="main"><?php echo TEXT_PRODUCTS_SH_AS; ?></td>
            <td class="main"><?php echo zen_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . zen_draw_input_field('products_sh_as', $pInfo->products_sh_as); ?></td>
          </tr>
          <tr bgcolor="#DDEACC">
            <td class="main"><?php echo TEXT_PRODUCTS_SH_AF; ?></td>
            <td class="main"><?php echo zen_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . zen_draw_input_field('products_sh_af', $pInfo->products_sh_af); ?></td>
          </tr>
          <tr bgcolor="#DDEACC">
            <td class="main"><?php echo TEXT_PRODUCTS_SH_AU; ?></td>
            <td class="main"><?php echo zen_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . zen_draw_input_field('products_sh_au', $pInfo->products_sh_au); ?></td>
          </tr>
          <tr>
            <td colspan="3"><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>
<?php } ?>