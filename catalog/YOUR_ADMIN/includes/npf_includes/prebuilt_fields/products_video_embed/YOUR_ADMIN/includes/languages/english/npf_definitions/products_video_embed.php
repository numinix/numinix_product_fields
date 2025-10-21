<?php

if (!defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
}

$define = [
    'TEXT_PRODUCTS_VIDEO_EMBED'          => 'Products Video Embed:',
    'TEXT_PRODUCTS_VIDEO_EMBED_THUMBNAIL' => 'Products Video Embed Thumbnail:',
];

$zc158 = (PROJECT_VERSION_MAJOR > 1 || (PROJECT_VERSION_MAJOR == 1 && substr(PROJECT_VERSION_MINOR, 0, 3) >= '5.8'));
if ($zc158) {
    return $define;
} else {
    nmx_create_defines($define);
}
