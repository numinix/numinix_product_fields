<?php

$sql_data_array['products_video_embed_2'] = isset($_POST['products_video_embed_2'][$language_id]) ? zen_db_prepare_input($_POST['products_video_embed_2'][$language_id]) : '';
$sql_data_array['products_video_embed_2_thumbnail'] = isset($_POST['products_video_embed_2_thumbnail']) ? zen_db_prepare_input($_POST['products_video_embed_2_thumbnail']) : '';
