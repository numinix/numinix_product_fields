<?php
/**
 * Numinix Product Fields - Catalog Product Display Observer
 *
 * Hooks into the product-info page to render NPF video (and other custom) fields.
 * Generated display modules live in includes/modules/npf_catalog_display/.
 *
 * @copyright Copyright 2003-2024 Zen Cart Development Team
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 */

if (defined('IS_ADMIN_FLAG') && IS_ADMIN_FLAG === true) {
    return;
}

if (!defined('PROJECT_VERSION_MAJOR') || !defined('PROJECT_VERSION_MINOR')) {
    return;
}

$npfZenCartVersion = PROJECT_VERSION_MAJOR . '.' . PROJECT_VERSION_MINOR;
if (version_compare($npfZenCartVersion, '1.5', '<') || !class_exists('base')) {
    return;
}

class zcObserverNpfProductDisplayObserver extends base
{
    protected $moduleDir;

    public function __construct()
    {
        $this->moduleDir = DIR_FS_CATALOG . 'includes/modules/npf_catalog_display/';
        $this->attach($this, ['NOTIFY_HEADER_END_PRODUCT_INFO']);
    }

    public function update(&$class, $eventID, $paramsArray = [])
    {
        if ($eventID === 'NOTIFY_HEADER_END_PRODUCT_INFO') {
            $this->buildProductExtraHtml();
        }
    }

    protected function buildProductExtraHtml()
    {
        $GLOBALS['npf_product_extra_html'] = '';
        $product_info = $GLOBALS['product_info'] ?? null;

        if (empty($product_info) || !isset($product_info->fields) || $product_info->EOF || !is_dir($this->moduleDir)) {
            return;
        }

        foreach ($this->phpFilesIn($this->moduleDir) as $file) {
            include $this->moduleDir . $file;
        }
    }

    protected function phpFilesIn($directory)
    {
        if (!is_dir($directory)) {
            return [];
        }

        $files = array_filter(scandir($directory), static function ($filename) use ($directory) {
            return pathinfo($filename, PATHINFO_EXTENSION) === 'php'
                && is_file($directory . $filename);
        });
        sort($files);

        return $files;
    }
}
