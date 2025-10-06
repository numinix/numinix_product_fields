<div class="form-group">
	<p class="col-sm-3 control-label"><?php echo TEXT_CARE_INSTRUCTIONS; ?></p>
	<div class="col-sm-9 col-md-6">
		<?php for ($i = 0, $n = sizeof($languages); $i < $n; $i++) { ?>
		<div class="input-group">
			<span class="input-group-addon">
				<?php echo zen_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']); ?>
			</span>
			<?php
			$care_instructions_ = isset($care_instructions[$languages[$i]['id']]) ? stripslashes($care_instructions[$languages[$i]['id']]) : zen_get_field_from_table_products_description($pInfo->products_id, $languages[$i]['id'], 'care_instructions');
			$care_instructions_ = ($care_instructions_ === null) ? '' : $care_instructions_;
			echo zen_draw_textarea_field('care_instructions[' . $languages[$i]['id'] . ']', 'soft', '100', '30', htmlspecialchars($care_instructions_, ENT_COMPAT, CHARSET, true), 'class="editorHook form-control"');
			?>
		</div>
		<br>
		<?php } ?>
	</div>
</div>