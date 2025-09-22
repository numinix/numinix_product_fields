<div class="form-group">
    <?php echo zen_draw_label(TEXT_PRODUCTS_OUT_OF_STOCK, 'out_of_stock', 'class="col-sm-3 control-label"'); ?>
    <div class="col-sm-9 col-md-6">
        <?php echo zen_draw_checkbox_field('out_of_stock', 1, ($pInfo->out_of_stock) ? true : false, '', 'id="out_of_stock"'); ?>
    </div>
</div>