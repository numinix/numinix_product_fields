<?php

if (!defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
}

$define = [
    'TEXT_PRODUCTS_VIDEO_EMBED_2'          => 'Products Video Embed Code 2:',
    'TEXT_PRODUCTS_VIDEO_EMBED_2_THUMBNAIL' => 'Products Video Embed 2 Thumbnail:',
];

$zc158 = (PROJECT_VERSION_MAJOR > 1 || (PROJECT_VERSION_MAJOR == 1 && substr(PROJECT_VERSION_MINOR, 0, 3) >= '5.8'));
if ($zc158) {
    return $define;
} else {
    nmx_create_defines($define);
}
