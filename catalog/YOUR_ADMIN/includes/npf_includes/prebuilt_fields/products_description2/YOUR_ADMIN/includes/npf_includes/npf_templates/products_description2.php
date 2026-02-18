<div class="form-group">
	<p class="col-sm-3 control-label"><?php echo TEXT_PRODUCTS_DESCRIPTION2; ?></p>
	<div class="col-sm-9 col-md-6">
		<?php for ($i = 0, $n = sizeof($languages); $i < $n; $i++) { ?>
		<div class="input-group">
			<span class="input-group-addon">
				<?php echo zen_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']); ?>
			</span>
			<?php
			$products_description2_ = isset($products_description2[$languages[$i]['id']]) ? stripslashes($products_description2[$languages[$i]['id']]) : zen_get_field_from_table_products_description($pInfo->products_id, $languages[$i]['id'], 'products_description2');
			$products_description2_ = ($products_description2_ === null) ? '' : $products_description2_;
			echo zen_draw_textarea_field('products_description2[' . $languages[$i]['id'] . ']', 'soft', '100', '30', htmlspecialchars($products_description2_, ENT_COMPAT, CHARSET, true), 'class="editorHook form-control"');
			?>
		</div>
		<br>
		<?php } ?>
	</div>
</div>