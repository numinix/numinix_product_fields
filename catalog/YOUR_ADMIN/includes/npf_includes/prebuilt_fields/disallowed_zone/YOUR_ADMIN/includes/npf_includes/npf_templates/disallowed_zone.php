
<div class="form-group">
    <?php echo zen_draw_label(TEXT_PRODUCTS_DISALLOWED_ZONE, 'disallowed_zone', 'class="col-sm-3 control-label"'); ?>
    <div class="col-sm-9 col-md-6">
        <?php echo str_replace('<select name="disallowed_zone">', '<select name="disallowed_zone" class="form-control"><option value="0">' . TEXT_SELECT_AN_OPTION . '</option>', zen_geo_zones_pull_down('name="disallowed_zone"', $pInfo->disallowed_zone));?>
    </div>
</div>

