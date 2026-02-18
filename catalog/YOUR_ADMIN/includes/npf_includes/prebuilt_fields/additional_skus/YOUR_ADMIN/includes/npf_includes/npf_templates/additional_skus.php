<div class="form-group">
    <?php echo zen_draw_label(TEXT_PRODUCTS_ADDITIONAL_SKUS, 'additional_skus', 'class="col-sm-3 control-label"'); ?>
    <div class="col-sm-9 col-md-6">
        <?php echo zen_draw_input_field('additional_skus', $pInfo->additional_skus, 'class="form-control" id="additional_skus"'); ?>
    </div>
</div>
<div class="form-group">
    <?php echo zen_draw_label(TEXT_PRODUCTS_ADDITIONAL_SKUS_ONLY, 'additional_skus_only', 'class="col-sm-3 control-label"'); ?>
    <div class="col-sm-9 col-md-6">
        <?php echo zen_draw_checkbox_field('additional_skus_only', 1, ($pInfo->additional_skus_only) ? true : false, '', 'id="additional_skus_only"'); ?>
    </div>
</div>