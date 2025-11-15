<?php
/**
 * Numinix Product Fields - Product Update Helper
 * 
 * This file provides hooks for NPF to integrate with product update processing.
 * Include this file from update_product.php after the $sql_data_array is created.
 * 
 * @copyright Copyright 2003-2024 Zen Cart Development Team
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 */

if (!defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
}

// Build NPF SQL array for products table
if (defined('NPF_INCLUDES_SQL_ARRAY_FOLDER') && is_dir(NPF_INCLUDES_SQL_ARRAY_FOLDER)) {
    $dirList = dirList(NPF_INCLUDES_SQL_ARRAY_FOLDER);
    foreach ($dirList as $file) {
        include(NPF_INCLUDES_SQL_ARRAY_FOLDER . $file);
    }
}
