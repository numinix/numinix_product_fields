<?php
/**
 * Numinix Product Fields - Catalog Product Display Observer
 *
 * Hooks into the product-info page to render NPF video (and other custom) fields.
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
    public function __construct()
    {
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

        if (empty($product_info) || !isset($product_info->fields) || $product_info->EOF) {
            return;
        }

        $this->appendVideoFieldsFromProductInfo($product_info);
    }

    protected function appendVideoFieldsFromProductInfo($product_info)
    {
        if (!function_exists('zen_npf_video') || empty($product_info->fields) || !is_array($product_info->fields)) {
            return;
        }

        foreach ($product_info->fields as $field => $value) {
            if (!is_string($field) || !is_string($value) || $value === '') {
                continue;
            }

            $videoHtml = zen_npf_video($value);
            if ($videoHtml === '') {
                continue;
            }

            $label = ucwords(str_replace('_', ' ', $field));
            $GLOBALS['npf_product_extra_html'] .= '<div class="npf-video-field" style="margin:12px 0">'
                . '<strong>' . htmlspecialchars($label, ENT_QUOTES, CHARSET) . '</strong><br>'
                . $videoHtml
                . '</div>';
        }
    }

}
