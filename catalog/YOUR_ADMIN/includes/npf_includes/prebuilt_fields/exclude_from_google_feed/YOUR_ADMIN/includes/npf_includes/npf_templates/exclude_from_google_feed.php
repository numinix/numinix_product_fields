<div class="form-group">
    <?php echo zen_draw_label(TEXT_EXCLUDE_FROM_GOOGLE_FEED, 'exclude_from_google_feed', 'class="col-sm-3 control-label"'); ?>
    <div class="col-sm-9 col-md-6">
        <?php echo zen_draw_checkbox_field('exclude_from_google_feed', 1, ($pInfo->exclude_from_google_feed) ? true : false, '', 'id="exclude_from_google_feed"'); ?>
    </div>
</div>