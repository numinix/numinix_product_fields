<?php 

$zc156 = (PROJECT_VERSION_MAJOR > 1 || (PROJECT_VERSION_MAJOR == 1 && substr(PROJECT_VERSION_MINOR, 0, 3) >= 5.6));
$npf_exclude_from_google_feed = true;
if($zc156){ ?>
          <div class="form-group">
              <?php echo zen_draw_label(TEXT_EXCLUDE_FROM_GOOGLE_FEED, 'exclude_from_google_feed', 'class="col-sm-3 control-label"'); ?>
            <div class="col-sm-9 col-md-6">
              <?php echo zen_draw_checkbox_field('exclude_from_google_feed', '1', $pInfo->exclude_from_google_feed); ?>
            </div>
          </div>
<?php } else { ?>
          <tr>
            <td colspan="2"><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>          
          <tr bgcolor="#DDEACC">
            <td class="main"><?php echo TEXT_EXCLUDE_FROM_GOOGLE_FEED; ?></td>
            <td class="main"><?php echo zen_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . zen_draw_input_field('exclude_from_google_feed', $pInfo->exclude_from_google_feed, '', 'checkbox'); ?></td>
          </tr>
          <tr>
            <td colspan="2"><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>
<?php } ?>