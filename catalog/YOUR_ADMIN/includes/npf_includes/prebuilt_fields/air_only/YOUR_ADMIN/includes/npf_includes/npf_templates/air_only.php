<div class="form-group">
    <?php echo zen_draw_label(TEXT_PRODUCTS_AIR_ONLY, 'air_only', 'class="col-sm-3 control-label"'); ?>
    <div class="col-sm-9 col-md-6">
        <?php echo zen_draw_checkbox_field('air_only', 1, ($pInfo->air_only) ? true : false, '', 'id="air_only"'); ?>
    </div>
</div>