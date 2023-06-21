<?php
  (isset($_POST['products_video_embed'])) ? $sql_data_array['products_video_embed'] = zen_db_prepare_input($_POST['products_video_embed']) : '';
  (isset($_POST['products_video_embed_thumbnail'])) ? $sql_data_array['products_video_embed_thumbnail'] = zen_db_prepare_input($_POST['products_video_embed_thumbnail']) : '';
?>