<div class="form-group">
    <?php echo zen_draw_label(TEXT_PRODUCTS_ONLINE_ONLY, 'online_only', 'class="col-sm-3 control-label"'); ?>
    <div class="col-sm-9 col-md-6">
        <?php echo zen_draw_checkbox_field('online_only', 1, ($pInfo->online_only) ? true : false, '', 'id="online_only"'); ?>
    </div>
</div>