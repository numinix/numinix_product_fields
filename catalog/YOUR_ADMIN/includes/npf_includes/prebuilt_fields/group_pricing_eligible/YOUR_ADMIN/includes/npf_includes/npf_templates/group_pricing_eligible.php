<div class="form-group">
    <?php echo zen_draw_label(TEXT_GROUP_PRICING_ELIGIBLE, 'group_pricing_eligible', 'class="col-sm-3 control-label"'); ?>
    <div class="col-sm-9 col-md-6">
        <?php echo zen_draw_checkbox_field('group_pricing_eligible', 1, ($pInfo->group_pricing_eligible) ? true : false, '', 'id="group_pricing_eligible"'); ?>
    </div>
</div>