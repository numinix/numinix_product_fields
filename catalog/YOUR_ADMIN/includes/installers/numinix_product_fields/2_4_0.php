<?php

$condition_query = $db->Execute("SELECT configuration_key FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = 'NPF_UPLOAD_FOLDER'");
if ($condition_query->Recordcount() == 0) {
    $db->Execute(
        "INSERT INTO " . TABLE_CONFIGURATION . " (configuration_group_id, configuration_key, configuration_title, configuration_value, configuration_description) 
        VALUES (" . (int) $configuration_group_id . ", 'NPF_UPLOAD_FOLDER', 'Upload Folder for Files', 'media', 'This is the directory that files will be uploaded to. Default is media');"
    );
}

if (version_compare(PROJECT_VERSION_MAJOR . '.' . PROJECT_VERSION_MINOR, '1.5.0') >= 0) {
    // Continue Zen Cart 1.5.0
    // Add to configuration menus
    if (
        function_exists('zen_page_key_exists') &&
        function_exists('zen_register_admin_page') &&
        !zen_page_key_exists('configNPF')
    ) {
        zen_register_admin_page(
            'configNPF',
            'TEXT_NUMINIX_PRODUCT_FIELDS',
            'FILENAME_CONFIGURATION',
            'gID=' . (int) $configuration_group_id,
            'configuration',
            'Y',
            999
        );
        $messageStack->add('NPF Configuration menu.', 'success');
    }
}
