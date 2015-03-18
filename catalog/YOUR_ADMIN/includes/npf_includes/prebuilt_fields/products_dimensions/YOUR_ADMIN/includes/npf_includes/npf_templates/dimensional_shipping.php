          <tr>
            <td colspan="2"><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>
          <tr bgcolor="#DDEACC">
            <td class="main"><?php echo TEXT_PRODUCTS_WEIGHT_UNITS;?></td>
            <td class="main" colspan="2"><?php echo zen_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . zen_draw_radio_field('products_weight_type', UNITS_KGS, $in_weight_type) . '&nbsp;' . UNITS_KGS . ' ' . zen_draw_radio_field('products_weight_type', UNITS_LBS, $out_weight_type) . '&nbsp;' . UNITS_LBS; ?>
            </td>
          </tr>
          <tr bgcolor="#DDEACC">
            <td class="main"><?php echo TEXT_PRODUCTS_DIM_UNITS; ?></td>
            <td class="main" colspan="2"><?php echo zen_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . zen_draw_radio_field('products_dim_type', UNITS_CM, $in_dim_type) . '&nbsp;' . UNITS_CM . ' ' . zen_draw_radio_field('products_dim_type', UNITS_IN, $out_dim_type) . '&nbsp;' . UNITS_IN; ?></td>
          </tr>
          <tr bgcolor="#DDEACC">
            <td class="main"><?php echo TEXT_PRODUCTS_LENGTH; ?></td>
            <td class="main" colspan="2"><?php echo zen_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . zen_draw_input_field('products_length', $pInfo->products_length); ?></td>
          </tr>
          <tr bgcolor="#DDEACC">
            <td class="main"><?php echo TEXT_PRODUCTS_WIDTH; ?></td>
            <td class="main" colspan="2"><?php echo zen_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . zen_draw_input_field('products_width', $pInfo->products_width); ?></td>
          </tr>
          <tr bgcolor="#DDEACC">
            <td class="main"><?php echo TEXT_PRODUCTS_HEIGHT; ?></td>
            <td class="main" colspan="2"><?php echo zen_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . zen_draw_input_field('products_height', $pInfo->products_height); ?></td>
          </tr>
          <tr bgcolor="#DDEACC">
            <td class="main"><?php echo TEXT_PRODUCTS_DIAMETER; ?></td>
            <td class="main" colspan="2"><?php echo zen_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . zen_draw_input_field('products_diameter', $pInfo->products_diameter); ?></td>
          </tr>          
          <tr bgcolor="#DDEACC">
            <td class="main"><?php echo TEXT_PRODUCTS_READY_TO_SHIP; ?></td>
            <td class="main" colspan="2"><?php echo zen_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . zen_draw_checkbox_field('products_ready_to_ship', '1', $pInfo->products_ready_to_ship) . '&nbsp;' . TEXT_PRODUCTS_READY_TO_SHIP_SELECTION . '&nbsp;' ?></td>
          </tr>
          <tr>
            <td colspan="2"><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>