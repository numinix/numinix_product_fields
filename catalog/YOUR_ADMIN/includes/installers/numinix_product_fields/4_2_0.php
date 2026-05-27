<?php
/**
 * Numinix Product Fields Installer - Version 4.2.0
 *
 * Video upload hardening release.
 * - Validates generated video paths against the configured upload folder.
 * - Adds server-side upload size checks for generated video fields.
 * - Updates generated video field defaults to avoid silent overwrites.
 *
 * @copyright Copyright 2003-2024 Zen Cart Development Team
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 */

if (!defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
}

// No database changes needed for this version.
// This is a hardening release focused on video upload security.