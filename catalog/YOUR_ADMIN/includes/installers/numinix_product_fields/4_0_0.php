<?php
/**
 * Numinix Product Fields Installer - Version 4.0.0
 * 
 * Major refactoring for Zen Cart v2 only.
 * - Uses NOTIFY_ADMIN_PRODUCT_PRICE_EDIT_ABOVE notification system
 * - Removes need for most core file modifications
 * - Drops support for Zen Cart < v2.0
 * 
 * @copyright Copyright 2003-2024 Zen Cart Development Team
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 */

if (!defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
}

// No database changes needed for this version
// This is a refactoring release
