<?php
/**
 * Numinix Product Fields - Collect Info SQL Helper
 * 
 * This file provides SQL extensions for loading NPF data in collect_info.php.
 * Include this file from collect_info.php before the product query.
 * 
 * @copyright Copyright 2003-2024 Zen Cart Development Team
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 */

if (!defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
}

// Build NPF SQL fields and table joins for loading product data
$npf_fields = "";
$npf_tables = "";

if (defined('NPF_INCLUDES_SQL_FOLDER') && is_dir(NPF_INCLUDES_SQL_FOLDER)) {
    $dirList = dirList(NPF_INCLUDES_SQL_FOLDER);
    foreach ($dirList as $file) {
        include(NPF_INCLUDES_SQL_FOLDER . $file);
    }
}
