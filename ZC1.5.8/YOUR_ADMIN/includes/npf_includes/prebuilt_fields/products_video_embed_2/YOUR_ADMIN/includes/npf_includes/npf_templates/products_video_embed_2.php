<?php 

$zc156 = (PROJECT_VERSION_MAJOR > 1 || (PROJECT_VERSION_MAJOR == 1 && substr(PROJECT_VERSION_MINOR, 0, 3) >= 5.6));

$filename = 'products_video_embed_2.php';

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
          <p class="col-sm-3 control-label"><?php echo TEXT_PRODUCTS_VIDEO_EMBED_2; ?></p>
        <div class="col-sm-9 col-md-6">
                    <div class="input-group">
                          <?php echo zen_draw_textarea_field('products_video_embed_2', 'soft', '100%', '30', $pInfo->products_video_embed_2); ?>
                    </div>
        </div>
    </div>
    <div class="form-group">
          <p class="col-sm-3 control-label"><?php echo TEXT_PRODUCTS_VIDEO_EMBED_2_THUMBNAIL; ?></p>
        <div class="col-sm-9 col-md-6">
          <div class="input-group">
                  <?php echo zen_draw_input_field('products_video_embed_2_thumbnail', $pInfo->products_video_embed_2_thumbnail, zen_set_field_length(TABLE_PRODUCTS_DESCRIPTION, 'products_video_embed_2_thumbnail')); ?>
          </div>
        </div>
    </div> 
<?php } else { ?>
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

<?php } ?>