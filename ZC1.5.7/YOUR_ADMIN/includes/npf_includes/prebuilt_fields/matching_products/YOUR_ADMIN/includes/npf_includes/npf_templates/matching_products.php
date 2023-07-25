<?php
  // skip the current product
  $products_array = array((int)$_GET['pID']);
?>


<?php 

$zc156 = (PROJECT_VERSION_MAJOR > 1 || (PROJECT_VERSION_MAJOR == 1 && substr(PROJECT_VERSION_MINOR, 0, 3) >= 5.6));

if($zc156){ ?>
          <div class="form-group">
              <?php echo zen_draw_label(TEXT_PRODUCTS_MATCHING_COLOR, 'matching_color', 'class="col-sm-3 control-label"'); ?>
            <div class="col-sm-9 col-md-6">
                <?php echo zen_draw_pull_down_menu('matching_color', $products_array, true, $pInfo->matching_color, true); ?>
            </div>
          </div>
          <div class="form-group">
              <?php echo zen_draw_label(TEXT_PRODUCTS_MATCHING_FLEECE, 'matching_fleece', 'class="col-sm-3 control-label"'); ?>
            <div class="col-sm-9 col-md-6">
                <?php echo zen_draw_pull_down_menu('matching_fleece', $products_array, true, $pInfo->matching_fleece, true); ?>
            </div>
          </div>
          <div class="form-group">
              <?php echo zen_draw_label(TEXT_PRODUCTS_MATCHING_TANK, 'matching_tank', 'class="col-sm-3 control-label"'); ?>
            <div class="col-sm-9 col-md-6">
                <?php echo zen_draw_pull_down_menu('matching_tank', $products_array, true, $pInfo->matching_tank, true); ?>
            </div>
          </div>
          <div class="form-group">
              <?php echo zen_draw_label(TEXT_PRODUCTS_MATCHING_TSHIRT, 'matching_tshirt', 'class="col-sm-3 control-label"'); ?>
            <div class="col-sm-9 col-md-6">
                <?php echo zen_draw_pull_down_menu('matching_tshirt', $products_array, true, $pInfo->matching_tshirt, true); ?>
            </div>
          </div>
          <div class="form-group">
              <?php echo zen_draw_label(TEXT_PRODUCTS_MATCHING_GENDER, 'matching_gender', 'class="col-sm-3 control-label"'); ?>
            <div class="col-sm-9 col-md-6">
                <?php echo zen_draw_pull_down_menu('matching_gender', $products_array, true, $pInfo->matching_gender, true); ?>
            </div>
          </div>
          <div class="form-group">
              <?php echo zen_draw_label(TEXT_PRODUCTS_MATCHING_YOUTH, 'matching_youth', 'class="col-sm-3 control-label"'); ?>
            <div class="col-sm-9 col-md-6">
                <?php echo zen_draw_pull_down_menu('matching_youth', $products_array, true, $pInfo->matching_youth, true); ?>
            </div>
          </div>
<?php } else { ?>
          <tr>
            <td colspan="2"><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>          
          <tr bgcolor="#DDEACC">
            <td class="main"><?php echo TEXT_PRODUCTS_MATCHING_COLOR; ?></td>
            <td class="main"><?php echo zen_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . zen_draw_pull_down_menu('matching_color', $products_array, true, $pInfo->matching_color, true); ?></td>
          </tr>
          <tr bgcolor="#DDEACC">
            <td class="main"><?php echo TEXT_PRODUCTS_MATCHING_FLEECE; ?></td>
            <td class="main"><?php echo zen_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . zen_draw_pull_down_menu('matching_fleece', $products_array, true, $pInfo->matching_fleece, true); ?></td>
          </tr>
          <tr bgcolor="#DDEACC">
            <td class="main"><?php echo TEXT_PRODUCTS_MATCHING_TANK; ?></td>
            <td class="main"><?php echo zen_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . zen_draw_pull_down_menu('matching_tank', $products_array, true, $pInfo->matching_tank, true); ?></td>
          </tr>
          <tr bgcolor="#DDEACC">
            <td class="main"><?php echo TEXT_PRODUCTS_MATCHING_TSHIRT; ?></td>
            <td class="main"><?php echo zen_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . zen_draw_pull_down_menu('matching_tshirt', $products_array, true, $pInfo->matching_tshirt, true); ?></td>
          </tr>
          <tr bgcolor="#DDEACC">
            <td class="main"><?php echo TEXT_PRODUCTS_MATCHING_GENDER; ?></td>
            <td class="main"><?php echo zen_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . zen_draw_pull_down_menu('matching_gender', $products_array, true, $pInfo->matching_gender, true); ?></td>
          </tr>
          <tr bgcolor="#DDEACC">
            <td class="main"><?php echo TEXT_PRODUCTS_MATCHING_YOUTH; ?></td>
            <td class="main"><?php echo zen_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . zen_draw_pull_down_menu('matching_youth', $products_array, true, $pInfo->matching_youth, true); ?></td>
          </tr>                              
          <tr>
            <td colspan="2"><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>
<?php } ?>