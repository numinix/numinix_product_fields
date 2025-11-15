<?php
/**
 * Numinix Product Fields - Custom Execution Helper
 * 
 * This file provides hooks for NPF custom execution scripts.
 * Include this file from update_product.php after product data is saved.
 * 
 * @copyright Copyright 2003-2024 Zen Cart Development Team
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 */

if (!defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
}

// Execute NPF custom scripts
if (defined('NPF_INCLUDES_CUSTOM_EXECUTE_FOLDER') && is_dir(NPF_INCLUDES_CUSTOM_EXECUTE_FOLDER)) {
    $dirList = dirList(NPF_INCLUDES_CUSTOM_EXECUTE_FOLDER);
    foreach ($dirList as $file) {
        include(NPF_INCLUDES_CUSTOM_EXECUTE_FOLDER . $file);
    }
}
