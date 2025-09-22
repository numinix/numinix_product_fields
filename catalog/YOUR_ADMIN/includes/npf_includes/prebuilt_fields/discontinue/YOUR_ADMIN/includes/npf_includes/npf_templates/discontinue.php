<div class="form-group">
    <?php echo zen_draw_label(TEXT_PRODUCTS_DISCONTINUE, 'discontinue', 'class="col-sm-3 control-label"'); ?>
    <div class="col-sm-9 col-md-6">
        <?php echo zen_draw_checkbox_field('discontinue', 1, ($pInfo->discontinue) ? true : false, '', 'id="discontinue"'); ?>
    </div>
</div>