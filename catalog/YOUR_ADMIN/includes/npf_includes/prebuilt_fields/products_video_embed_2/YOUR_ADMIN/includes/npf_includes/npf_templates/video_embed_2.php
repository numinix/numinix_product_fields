          <tr>
            <td class="main" valign="top"><?php echo TEXT_PRODUCTS_VIDEO_EMBED_2; ?></td>
            <td colspan="2">
              <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td class="main" width="100%">
                    <?php echo zen_draw_textarea_field('products_video_embed_2', 'soft', '100%', '30', $pInfo->products_video_embed_2); ?>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
          <tr bgcolor="#DDEACC">
            <td class="main"><?php echo TEXT_PRODUCTS_VIDEO_EMBED_2_THUMBNAIL; ?></td>
            <td class="main"><?php echo zen_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . zen_draw_input_field('products_video_embed_2_thumbnail', $pInfo->products_video_embed_2_thumbnail, zen_set_field_length(TABLE_PRODUCTS_DESCRIPTION, 'products_video_embed_2_thumbnail')); ?></td>
          </tr>