<?php

$sql_data_array['products_video_embed'] = isset($_POST['products_video_embed'][$language_id]) ? zen_db_prepare_input($_POST['products_video_embed'][$language_id]) : '';
$sql_data_array['products_video_embed_thumbnail'] = isset($_POST['products_video_embed_thumbnail']) ? zen_db_prepare_input($_POST['products_video_embed_thumbnail']) : '';
