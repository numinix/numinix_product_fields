
<?php 
$zc201 = (PROJECT_VERSION_MAJOR > 2 || (PROJECT_VERSION_MAJOR == 2 && substr(PROJECT_VERSION_MINOR, 0, 3) >= 0.1));
if(!$zc201){ ?>
    <div class="form-group">
        <?php echo zen_draw_label(TEXT_PRODUCTS_WEIGHT_UNITS, 'products_weight_type', 'class="col-sm-3 control-label"'); ?>
        <div class="col-sm-9 col-md-6">
            <?php echo zen_draw_radio_field('products_weight_type', UNITS_KGS, $in_weight_type) . '&nbsp;' . UNITS_KGS . ' ' . zen_draw_radio_field('products_weight_type', UNITS_LBS, $out_weight_type) . '&nbsp;' . UNITS_LBS; ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo zen_draw_label(TEXT_PRODUCTS_DIM_UNITS, 'products_dim_type', 'class="col-sm-3 control-label"'); ?>
        <div class="col-sm-9 col-md-6">
            <?php echo zen_draw_radio_field('products_dim_type', UNITS_CM, $in_dim_type) . '&nbsp;' . UNITS_CM . ' ' . zen_draw_radio_field('products_dim_type', UNITS_IN, $out_dim_type) . '&nbsp;' . UNITS_IN; ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo zen_draw_label(TEXT_PRODUCTS_LENGTH, 'products_length', 'class="col-sm-3 control-label"'); ?>
        <div class="col-sm-9 col-md-6">
            <?php echo zen_draw_input_field('products_length', $pInfo->products_length, 'class="form-control" id="products_length"'); ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo zen_draw_label(TEXT_PRODUCTS_WIDTH, 'products_width', 'class="col-sm-3 control-label"'); ?>
        <div class="col-sm-9 col-md-6">
            <?php echo zen_draw_input_field('products_width', $pInfo->products_width, 'class="form-control" id="products_width"'); ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo zen_draw_label(TEXT_PRODUCTS_HEIGHT, 'products_height', 'class="col-sm-3 control-label"'); ?>
        <div class="col-sm-9 col-md-6">
            <?php echo zen_draw_input_field('products_height', $pInfo->products_height, 'class="form-control" id="products_height"'); ?>
        </div>
    </div>
<?php } ?>

<div class="form-group">
    <?php echo zen_draw_label(TEXT_PRODUCTS_DIAMETER, 'products_diameter', 'class="col-sm-3 control-label"'); ?>
    <div class="col-sm-9 col-md-6">
        <?php echo zen_draw_input_field('products_diameter', $pInfo->products_diameter, 'class="form-control" id="products_diameter"'); ?>
    </div>
</div>
<div class="form-group">
    <?php echo zen_draw_label(TEXT_PRODUCTS_READY_TO_SHIP, 'products_ready_to_ship', 'class="col-sm-3 control-label"'); ?>
    <div class="col-sm-9 col-md-6">
        <?php echo zen_draw_checkbox_field('products_ready_to_ship', 1, ($pInfo->products_ready_to_ship) ? true : false, '', 'id="products_ready_to_ship"'); ?>
    </div>
</div>
<div class="form-group">
    <?php echo zen_draw_label(TEXT_PRODUCTS_ACTUAL_WEIGHT, 'products_actual_weight', 'class="col-sm-3 control-label"'); ?>
    <div class="col-sm-9 col-md-6">
        <?php echo zen_draw_input_field('products_actual_weight', $pInfo->products_actual_weight, 'class="form-control" id="products_actual_weight"'); ?>
    </div>
</div>