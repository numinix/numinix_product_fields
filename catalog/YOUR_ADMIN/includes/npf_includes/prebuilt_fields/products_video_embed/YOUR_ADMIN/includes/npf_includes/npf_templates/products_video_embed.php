<?php 

$zc156 = (PROJECT_VERSION_MAJOR > 1 || (PROJECT_VERSION_MAJOR == 1 && substr(PROJECT_VERSION_MINOR, 0, 3) >= 5.6));
if($zc156){ ?>
          <div class="form-group">
            <div class="col-sm-9 col-md-6">
              <table>
                <tr>
                  <td class="main" valign="top"><?php echo TEXT_PRODUCTS_VIDEO_EMBED; ?></td>
                  <td colspan="2">
                    <table border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td class="main" width="100%">
                        <?php echo zen_draw_textarea_field('products_video_embed', 'soft', '100%', '30', $pInfo->products_video_embed); ?>                  </td>
                      </tr>
                    </table>
                  </td>
                </tr>
                <tr bgcolor="#DDEACC">
                  <td class="main"><?php echo TEXT_PRODUCTS_VIDEO_EMBED_THUMBNAIL; ?></td>
                  <td class="main"><?php echo zen_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . zen_draw_input_field('products_video_embed_thumbnail', $pInfo->products_video_embed_thumbnail, zen_set_field_length(TABLE_PRODUCTS_DESCRIPTION, 'products_video_embed_thumbnail')); ?></td>
                </tr>
              </table>
            </div>
          </div>
<?php } else { ?>
          <tr>
            <td class="main" valign="top"><?php echo TEXT_PRODUCTS_VIDEO_EMBED; ?></td>
            <td colspan="2">
              <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td class="main" width="100%">
                  <?php echo zen_draw_textarea_field('products_video_embed', 'soft', '100%', '30', $pInfo->products_video_embed); ?>                  </td>
                </tr>
              </table>
            </td>
          </tr>
          <tr bgcolor="#DDEACC">
            <td class="main"><?php echo TEXT_PRODUCTS_VIDEO_EMBED_THUMBNAIL; ?></td>
            <td class="main"><?php echo zen_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . zen_draw_input_field('products_video_embed_thumbnail', $pInfo->products_video_embed_thumbnail, zen_set_field_length(TABLE_PRODUCTS_DESCRIPTION, 'products_video_embed_thumbnail')); ?></td>
          </tr>

<?php } ?>