<div class="form-group">
	<p class="col-sm-3 control-label"><?php echo TEXT_PRODUCTS_VIDEO_EMBED_2; ?></p>
	<div class="col-sm-9 col-md-6">
		<?php for ($i = 0, $n = sizeof($languages); $i < $n; $i++) { ?>
		<div class="input-group">
			<span class="input-group-addon">
				<?php echo zen_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']); ?>
			</span>
			<?php
            $products_video_embed_2_ = isset($products_video_embed_2[$languages[$i]['id']]) ? stripslashes($products_video_embed_2[$languages[$i]['id']]) : zen_get_field_from_table_products_description($pInfo->products_id, $languages[$i]['id'], 'products_video_embed_2');
		    $products_video_embed_2_ = ($products_video_embed_2_ === null) ? '' : $products_video_embed_2_;
		    echo zen_draw_textarea_field('products_video_embed_2[' . $languages[$i]['id'] . ']', 'soft', '100', '30', htmlspecialchars($products_video_embed_2_, ENT_COMPAT, CHARSET, true), 'class="editorHook form-control"');
		    ?>
		</div>
		<br>
		<?php } ?>
	</div>
</div>
<div class="form-group">
    <?php echo zen_draw_label(TEXT_PRODUCTS_VIDEO_EMBED_2_THUMBNAIL, 'products_video_embed_2_thumbnail', 'class="col-sm-3 control-label"'); ?>
    <div class="col-sm-9 col-md-6">
        <?php echo zen_draw_input_field('products_video_embed_2_thumbnail', $pInfo->products_video_embed_2_thumbnail, 'class="form-control" id="products_video_embed_2_thumbnail"'); ?>
    </div>
</div>