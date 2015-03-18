<?php
  $testimonials = $db->Execute("SELECT * FROM " . TABLE_TESTIMONIALS_MANAGER . " WHERE status = 1 ORDER BY testimonials_name ASC;");
  if ($testimonials->RecordCount() > 0) {
    $testimonials_options = array(array('id' => 0, 'text' => 'Please select'));
    while (!$testimonials->EOF) {
      $testimonials_options[] = array('text' => $testimonials->fields['testimonials_title'], 'id' => $testimonials->fields['testimonials_id']);
      $testimonials->MoveNext();
    } 
?>
          <tr>
            <td colspan="2"><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>          
          <tr bgcolor="#DDEACC">
            <td class="main"><?php echo TEXT_PRODUCTS_TESTIMONIALS_ID; ?></td>
            <td class="main"><?php echo zen_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . zen_draw_pull_down_menu('products_testimonials_id', $testimonials_options, $pInfo->products_testimonials_id); ?></td>
          </tr>
          <tr>
            <td colspan="2"><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>
<?php
  }
?>