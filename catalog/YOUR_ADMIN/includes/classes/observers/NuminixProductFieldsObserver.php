<?php
/**
 * Numinix Product Fields Observer
 * 
 * Handles integration with Zen Cart v2 notification system to add product fields
 * without requiring core file modifications.
 * 
 * @copyright Copyright 2003-2024 Zen Cart Development Team
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 */

if (!defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
}

class NuminixProductFieldsObserver extends base
{
    public function __construct()
    {
        // Attach to the notification for adding fields to product edit form
        $this->attach($this, [
            'NOTIFY_ADMIN_PRODUCT_PRICE_EDIT_ABOVE',
            'NOTIFY_ADMIN_PRODUCT_COLLECT_INFO_EXTRA_INPUTS',
            'NOTIFY_MODULES_UPDATE_PRODUCT_START',
            'NOTIFY_ADMIN_PRODUCT_IMAGE_UPLOADED',
        ]);
    }

    /**
     * Handle notification events
     */
    public function update(&$class, $eventID, $paramsArray = [])
    {
        switch ($eventID) {
            case 'NOTIFY_ADMIN_PRODUCT_PRICE_EDIT_ABOVE':
                $this->addProductFields($paramsArray);
                break;
            case 'NOTIFY_ADMIN_PRODUCT_COLLECT_INFO_EXTRA_INPUTS':
                if ($this->currentCollectInfoHasLegacyNPFTemplateInclude()) {
                    return;
                }
                $this->addProductFields($paramsArray);
                break;
            case 'NOTIFY_ADMIN_PRODUCT_IMAGE_UPLOADED':
                if ($this->currentProductPageHasLegacyNPFPreviewInclude()) {
                    return;
                }
                $this->processProductPreview($paramsArray);
                break;
            case 'NOTIFY_MODULES_UPDATE_PRODUCT_START':
                $this->processProductUpdateStart($paramsArray);
                break;
        }
    }

    /**
     * Add NPF fields to the product edit form
     */
    protected function addProductFields(&$paramsArray)
    {
        global $db, $pInfo;
        static $npfFieldsRendered = false;

        if ($npfFieldsRendered) {
            return;
        }

        // Determine the product info object passed by the notifier.
        $incomingPInfo = null;
        if ($paramsArray instanceof objectInfo) {
            $incomingPInfo = $paramsArray;
        } elseif (is_array($paramsArray)) {
            if (isset($paramsArray['pInfo']) && $paramsArray['pInfo'] instanceof objectInfo) {
                $incomingPInfo = $paramsArray['pInfo'];
            } elseif (isset($paramsArray[0]) && $paramsArray[0] instanceof objectInfo) {
                $incomingPInfo = $paramsArray[0];
            }
        }

        if ($incomingPInfo instanceof objectInfo) {
            $pInfo = $incomingPInfo;
        }

        if (empty($pInfo)) {
            return;
        }

        /*
         * NPF templates were originally included directly from collect_info.php,
         * where variables such as $languages and posted field arrays were in
         * scope. Mirror that scope here so legacy/custom NPF templates continue
         * to work when loaded through the observer.
         */
        $legacyTemplateVars = array_intersect_key(
            $GLOBALS,
            array_flip([
                'languages',
                'pInfo',
                'currencies',
            ])
        );

        extract($legacyTemplateVars, EXTR_SKIP);

        if (empty($languages) || !is_array($languages)) {
            $languages = zen_get_languages();
        }

        // Load language definitions for NPF fields
        $this->loadNPFLanguageDefinitions();

        // Get list of NPF template files
        if (!defined('NPF_INCLUDES_TEMPLATES_FOLDER')) {
            return;
        }

        $npfFieldsRendered = true;

        foreach ($this->phpFilesIn(NPF_INCLUDES_TEMPLATES_FOLDER) as $file) {
            // NPF templates output complete <div class="form-group"> blocks for ZC 1.5.6+.
            // Instead of adding to $additional_fields and requiring a core file modification,
            // we directly output the HTML here. This eliminates the need for users to modify
            // collect_info.php in the Zen Cart core.
            include(NPF_INCLUDES_TEMPLATES_FOLDER . $file);
        }
    }

    /**
     * Run NPF file/video upload handlers during the product-preview step.
     * Fires on NOTIFY_ADMIN_PRODUCT_IMAGE_UPLOADED (new_product_preview.php).
     * Sets $_POST['{field}'] so preview_info.php forwards the path as a hidden field.
     */
    protected function processProductPreview(&$paramsArray)
    {
        if (defined('NPF_INCLUDES_PREVIEW_FOLDER') && is_dir(NPF_INCLUDES_PREVIEW_FOLDER)) {
            foreach ($this->phpFilesIn(NPF_INCLUDES_PREVIEW_FOLDER) as $file) {
                include(NPF_INCLUDES_PREVIEW_FOLDER . $file);
            }
        }
    }

    /**
     * Process NPF data at the start of product update
     */
    protected function processProductUpdateStart(&$paramsArray)
    {
        global $db, $sql_data_array, $products_id, $action;
        
        // Run NPF processing scripts
        if (defined('NPF_INCLUDES_PROCESSING_FOLDER') && is_dir(NPF_INCLUDES_PROCESSING_FOLDER)) {
            foreach ($this->phpFilesIn(NPF_INCLUDES_PROCESSING_FOLDER) as $file) {
                include(NPF_INCLUDES_PROCESSING_FOLDER . $file);
            }
        }

        // Note: NPF SQL array building requires access to $sql_data_array
        // See readme.html for required modifications to update_product.php
    }

    /**
     * Load language definitions for NPF fields
     */
    protected function loadNPFLanguageDefinitions()
    {
        $opt = defined('NPF_DEFINITIONS_FOLDER')
            ? NPF_DEFINITIONS_FOLDER
            : DIR_WS_LANGUAGES . ($_SESSION['language'] ?? 'english') . '/npf_definitions/';
        
        if (!is_dir($opt)) {
            return;
        }
        
        foreach ($this->phpFilesIn($opt) as $filename) {
            $defines = include $opt . $filename;
            if (is_array($defines)) {
                foreach ($defines as $key => $value) {
                    if (!defined($key)) {
                        define($key, $value);
                    }
                }
            }
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

    protected function currentCollectInfoHasLegacyNPFTemplateInclude()
    {
        if (!empty($GLOBALS['npf_legacy_templates_included']) || (defined('NPF_LEGACY_TEMPLATES_INCLUDED') && NPF_LEGACY_TEMPLATES_INCLUDED)) {
            return true;
        }

        return $this->stackFileContains(
            'collect_info.php',
            'NPF_INCLUDES_TEMPLATES_FOLDER',
            '/\b(?:include|include_once|require|require_once)\s*\(?\s*NPF_INCLUDES_TEMPLATES_FOLDER\b/'
        );
    }

    protected function currentProductPageHasLegacyNPFPreviewInclude()
    {
        if (!empty($GLOBALS['npf_legacy_preview_included']) || (defined('NPF_LEGACY_PREVIEW_INCLUDED') && NPF_LEGACY_PREVIEW_INCLUDED)) {
            return true;
        }

        return $this->stackFileContains(
            'product.php',
            'NPF_INCLUDES_PREVIEW_FOLDER',
            '/\b(?:include|include_once|require|require_once)\s*\(?\s*NPF_INCLUDES_PREVIEW_FOLDER\b/'
        );
    }

    protected function stackFileContains($basename, $needle, $pattern = null)
    {
        static $filesChecked = [];

        foreach (debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 10) as $frame) {
            if (empty($frame['file']) || basename($frame['file']) !== $basename) {
                continue;
            }

            $cacheKey = $frame['file'] . '|' . $needle . '|' . (string)$pattern;
            if (!isset($filesChecked[$cacheKey])) {
                $contents = file_get_contents($frame['file']);
                $filesChecked[$cacheKey] = $contents !== false
                    && strpos($contents, $needle) !== false
                    && ($pattern === null || preg_match($pattern, $contents) === 1);
            }

            return $filesChecked[$cacheKey];
        }

        return false;
    }
}
