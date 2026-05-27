<?php

//
// +----------------------------------------------------------------------+
// | zen-cart Open Source E-commerce                                      |
// +----------------------------------------------------------------------+
// | Copyright (c) 2007 Numinix Technology                                |
// | http://www.numinix.com                                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
//  $Id: npf_defines.php 4 2011-09-28 01:00:29Z numinix $
//
// Numinix Product Fields

// Autoload all definitions in the npf_definitions folder
define('TEXT_NUMINIX_PRODUCT_FIELDS', 'Numinix Product Fields');

define('NPF_DEFINITIONS_FOLDER', DIR_WS_LANGUAGES . $_SESSION['language'] . '/npf_definitions/');
define('NPF_INCLUDES_FOLDER', DIR_WS_INCLUDES . 'npf_includes/');
define('NPF_INCLUDES_SQL_FOLDER', NPF_INCLUDES_FOLDER . 'npf_sql/');
define('NPF_INCLUDES_MODULES_FOLDER', NPF_INCLUDES_FOLDER . 'npf_modules/');
define('NPF_INCLUDES_TEMPLATES_FOLDER', NPF_INCLUDES_FOLDER . 'npf_templates/');
define('NPF_INCLUDES_PROCESSING_FOLDER', NPF_INCLUDES_FOLDER . 'npf_process/');
define('NPF_INCLUDES_SQL_ARRAY_FOLDER', NPF_INCLUDES_FOLDER . 'npf_sql_array/');
define('NPF_INCLUDES_CUSTOM_EXECUTE_FOLDER', NPF_INCLUDES_FOLDER . 'npf_custom_execute/');
define('NPF_INCLUDES_DESCRIPTION_SQL_ARRAY_FOLDER', NPF_INCLUDES_FOLDER . 'npf_description_sql_array/');
define('NPF_INCLUDES_PREVIEW_FOLDER', NPF_INCLUDES_FOLDER . 'npf_preview/');
define('NPF_INCLUDES_PREVIEW_INFO_FOLDER', NPF_INCLUDES_FOLDER . 'npf_preview_info/');
define('NPF_INCLUDES_PREBUILT_FOLDER', NPF_INCLUDES_FOLDER . 'prebuilt_fields/');

$dirList = dirList(NPF_DEFINITIONS_FOLDER);
foreach ($dirList as $file) {
    if (pathinfo($file, PATHINFO_EXTENSION) !== 'php') {
        continue;
    }

    $defines = include NPF_DEFINITIONS_FOLDER . $file;
    if (!is_array($defines)) {
        continue;
    }

    foreach ($defines as $key => $value) {
        if (!defined($key)) {
            define($key, $value);
        }
    }
}
// eof
