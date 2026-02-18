<div class="form-group">
    <?php echo zen_draw_label(TEXT_PRODUCTS_DROPSHIP, 'dropship', 'class="col-sm-3 control-label"'); ?>
    <div class="col-sm-9 col-md-6">
        <?php echo zen_draw_checkbox_field('dropship', 1, ($pInfo->dropship) ? true : false, '', 'id="dropship"'); ?>
    </div>
</div>