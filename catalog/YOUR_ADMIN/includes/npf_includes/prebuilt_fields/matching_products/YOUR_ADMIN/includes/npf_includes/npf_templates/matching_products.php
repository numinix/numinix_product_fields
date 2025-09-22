<?php
// skip the current product
$products_array = array((int)$_GET['pID']);
$zcVersion158 = (PROJECT_VERSION_MAJOR > 1 || (PROJECT_VERSION_MAJOR == 1 && substr(PROJECT_VERSION_MINOR, 0, 3) >= 5.8));
?>
<div class="form-group">
    <?php echo zen_draw_label(TEXT_PRODUCTS_MATCHING_COLOR, 'matching_color', 'class="col-sm-3 control-label"'); ?>
    <div class="col-sm-9 col-md-6">
        <?php if ($zcVersion158) {
            echo zen_draw_pulldown_products('matching_color', 'class="form-control" id="matching_color" size="15"', $products_array, true, $pInfo->matching_color, true);
        } else {
            echo zen_draw_products_pull_down('matching_color', 'class="form-control" id="matching_color" size="15"', $products_array, true, $pInfo->matching_color, true);
        } ?>
    </div>
</div>
<div class="form-group">
    <?php echo zen_draw_label(TEXT_PRODUCTS_MATCHING_FLEECE, 'matching_fleece', 'class="col-sm-3 control-label"'); ?>
    <div class="col-sm-9 col-md-6">
        <?php if ($zcVersion158) {
            echo zen_draw_pulldown_products('matching_fleece', 'class="form-control" id="matching_fleece" size="15"', $products_array, true, $pInfo->matching_fleece, true);
        } else {
            echo zen_draw_products_pull_down('matching_fleece', 'class="form-control" id="matching_fleece" size="15"', $products_array, true, $pInfo->matching_fleece, true);
        } ?>
    </div>
</div>
<div class="form-group">
    <?php echo zen_draw_label(TEXT_PRODUCTS_MATCHING_TANK, 'matching_tank', 'class="col-sm-3 control-label"'); ?>
    <div class="col-sm-9 col-md-6">
        <?php if ($zcVersion158) {
            echo zen_draw_pulldown_products('matching_tank', 'class="form-control" id="matching_tank" size="15"', $products_array, true, $pInfo->matching_tank, true);
        } else {
            echo zen_draw_products_pull_down('matching_tank', 'class="form-control" id="matching_tank" size="15"', $products_array, true, $pInfo->matching_tank, true);
        } ?>
    </div>
</div>
<div class="form-group">
    <?php echo zen_draw_label(TEXT_PRODUCTS_MATCHING_TSHIRT, 'matching_tshirt', 'class="col-sm-3 control-label"'); ?>
    <div class="col-sm-9 col-md-6">
        <?php if ($zcVersion158) {
            echo zen_draw_pulldown_products('matching_tshirt', 'class="form-control" id="matching_tshirt" size="15"', $products_array, true, $pInfo->matching_tshirt, true);
        } else {
            echo zen_draw_products_pull_down('matching_tshirt', 'class="form-control" id="matching_tshirt" size="15"', $products_array, true, $pInfo->matching_tshirt, true);
        } ?>
    </div>
</div>
<div class="form-group">
    <?php echo zen_draw_label(TEXT_PRODUCTS_MATCHING_GENDER, 'matching_gender', 'class="col-sm-3 control-label"'); ?>
    <div class="col-sm-9 col-md-6">
        <?php if ($zcVersion158) {
            echo zen_draw_pulldown_products('matching_gender', 'class="form-control" id="matching_gender" size="15"', $products_array, true, $pInfo->matching_gender, true);
        } else {
            echo zen_draw_products_pull_down('matching_gender', 'class="form-control" id="matching_gender" size="15"', $products_array, true, $pInfo->matching_gender, true);
        } ?>
    </div>
</div>
<div class="form-group">
    <?php echo zen_draw_label(TEXT_PRODUCTS_MATCHING_YOUTH, 'matching_youth', 'class="col-sm-3 control-label"'); ?>
    <div class="col-sm-9 col-md-6">
        <?php if ($zcVersion158) {
            echo zen_draw_pulldown_products('matching_youth', 'class="form-control" id="matching_youth" size="15"', $products_array, true, $pInfo->matching_youth, true);
        } else {
            echo zen_draw_products_pull_down('matching_youth', 'class="form-control" id="matching_youth" size="15"', $products_array, true, $pInfo->matching_youth, true);
        } ?>
    </div>
</div>