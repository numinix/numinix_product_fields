<?php 

$zc156 = (PROJECT_VERSION_MAJOR > 1 || (PROJECT_VERSION_MAJOR == 1 && substr(PROJECT_VERSION_MINOR, 0, 3) >= 5.6));

if($zc156){ ?>
          <div class="form-group">
              <?php echo zen_draw_label(TEXT_PRODUCTS_STOCK_BY_ATTRIBUTES, 'products_stock_by_attributes', 'class="col-sm-3 control-label"'); ?>
            <div class="col-sm-9 col-md-6">
                <?php echo '<a href="' . zen_href_link(FILENAME_PRODUCTS_WITH_ATTRIBUTES_STOCK, 'search=' . (int)$_GET['pID'] . '"', 'NONSSL') . '>Click here to go to stock by attributes</a>' ?>
            </div>
          </div>
<?php } else { ?>
          <tr>
            <td colspan="2"><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>          
          <tr bgcolor="#DDEACC">
            <td class="main"><?php echo TEXT_PRODUCTS_STOCK_BY_ATTRIBUTES; ?></td>
            <td class="main"><?php echo zen_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;<a href="' . zen_href_link(FILENAME_PRODUCTS_WITH_ATTRIBUTES_STOCK, 'search=' . (int)$_GET['pID'] . '"', 'NONSSL') . '>Click here to go to stock by attributes</a>'; ?></td>
          </tr>
          <tr>
            <td colspan="2"><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>
<?php } ?>