<?php
/**
 * Numinix Product Fields - Product/Category Header Code
 * 
 * This file is included by Zen Cart's product.php before the main product editing logic.
 * It provides a placeholder for any initialization code that NPF might need before
 * the product edit page loads.
 * 
 * For NPF v4.0+, this file is intentionally minimal as most functionality is handled
 * through the observer pattern (NuminixProductFieldsObserver class). NPF constants
 * are defined in includes/languages/english/extra_definitions/npf_defines.php.
 * 
 * @copyright Copyright 2003-2025 Zen Cart Development Team
 * @copyright Copyright 2024 Numinix
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version 4.1.0
 */

if (!defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
}

// This file serves as a placeholder to prevent fatal errors when Zen Cart's product.php
// attempts to include includes/modules/prod_cat_header_code.php.
// 
// NPF v4.0+ uses the observer pattern for product field integration, so no additional
// initialization code is required here. All NPF functionality is loaded through:
// - Auto-loader: includes/auto_loaders/config.numinix_product_fields.php
// - Observer: includes/classes/observers/NuminixProductFieldsObserver.php
// - Constants: includes/languages/english/extra_definitions/npf_defines.php
