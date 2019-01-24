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