<?php

if (!defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
}

$autoLoadConfig[999][] = [
    'autoType' => 'init_script',
    'loadFile' => 'init_numinix_product_fields.php',
];

// Load observer class for Zen Cart v2 notification system
$autoLoadConfig[200][] = [
    'autoType' => 'class',
    'loadFile' => 'observers/NuminixProductFieldsObserver.php',
    'classPath' => DIR_WS_CLASSES,
];

$autoLoadConfig[201][] = [
    'autoType' => 'classInstantiate',
    'className' => 'NuminixProductFieldsObserver',
    'objectName' => 'numinixProductFieldsObserver',
];
