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
            'NOTIFY_MODULES_UPDATE_PRODUCT_START'
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
        
        if (!isset($paramsArray[1]) || !is_array($paramsArray[1])) {
            return;
        }
        
        // Get pInfo from parameters
        if (isset($paramsArray[0])) {
            $pInfo = $paramsArray[0];
        }
        
        $additional_fields = &$paramsArray[1];
        
        if (!$pInfo) {
            return;
        }

        // Load language definitions for NPF fields
        $this->loadNPFLanguageDefinitions();

        // Get list of NPF template files
        if (!defined('NPF_INCLUDES_TEMPLATES_FOLDER')) {
            return;
        }

        $dirList = dirList(NPF_INCLUDES_TEMPLATES_FOLDER);
        
        foreach ($dirList as $file) {
            // Capture the output from the template file
            ob_start();
            include(NPF_INCLUDES_TEMPLATES_FOLDER . $file);
            $template_output = ob_get_clean();
            
            if (empty(trim($template_output))) {
                continue;
            }

            // The existing NPF templates output complete <div class="form-group"> blocks for ZC 1.5.6+.
            // We mark these with a special prefix so the collect_info.php template can detect
            // and output them without additional wrapping.
            // 
            // See readme.html for the required modification to collect_info.php
            
            $additional_fields[] = [
                'label' => '<!-- NPF_COMPLETE_HTML -->', 
                'fieldname' => '',
                'input' => $template_output
            ];
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
            $dirList = dirList(NPF_INCLUDES_PROCESSING_FOLDER);
            foreach ($dirList as $file) {
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
        $path = 'languages/english/npf_definitions/';
        $opt = DIR_WS_INCLUDES . $path;
        
        if (!is_dir($opt)) {
            return;
        }
        
        $files = scandir($opt);
        $files = array_diff($files, ['.', '..']);
        
        foreach ($files as $filename) {
            if (pathinfo($filename, PATHINFO_EXTENSION) !== 'php') {
                continue;
            }
            
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
}
