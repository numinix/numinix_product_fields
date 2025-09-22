<div class="form-group">
    <?php echo zen_draw_label(TEXT_PRODUCTS_UPC, 'products_upc', 'class="col-sm-3 control-label"'); ?>
    <div class="col-sm-9 col-md-6">
        <?php echo zen_draw_input_field('products_upc', $pInfo->products_upc, 'class="form-control" id="products_upc"'); ?>
    </div>
</div>
<div class="form-group">
    <?php echo zen_draw_label(TEXT_PRODUCTS_ISBN, 'products_isbn', 'class="col-sm-3 control-label"'); ?>
    <div class="col-sm-9 col-md-6">
        <?php echo zen_draw_input_field('products_isbn', $pInfo->products_isbn, 'class="form-control" id="products_isbn"'); ?>
    </div>
</div>
<div class="form-group">
    <?php echo zen_draw_label(TEXT_PRODUCTS_EAN, 'products_ean', 'class="col-sm-3 control-label"'); ?>
    <div class="col-sm-9 col-md-6">
        <?php echo zen_draw_input_field('products_ean', $pInfo->products_ean, 'class="form-control" id="products_ean"'); ?>
    </div>
</div>
<div class="form-group">
    <?php echo zen_draw_label(TEXT_PRODUCTS_ASIN, 'products_asin', 'class="col-sm-3 control-label"'); ?>
    <div class="col-sm-9 col-md-6">
        <?php echo zen_draw_input_field('products_asin', $pInfo->products_asin, 'class="form-control" id="products_asin"'); ?>
    </div>
</div>