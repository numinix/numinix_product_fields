<?php
  (isset($_POST['products_video_embed_2'])) ? $sql_data_array['products_video_embed_2'] = zen_db_prepare_input($_POST['products_video_embed_2']) : '';
  (isset($_POST['products_video_embed_2_thumbnail'])) ? $sql_data_array['products_video_embed_2_thumbnail'] = zen_db_prepare_input($_POST['products_video_embed_2_thumbnail']) : '';
?>