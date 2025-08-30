<?php

$sanitation_rules_dir = DIR_FS_ADMIN . 'includes/init_includes/extra_sanitation_rules';
$sanitation_rules = glob($sanitation_rules_dir . '/*.php');

if (!empty($sanitation_rules)) {
	foreach ($sanitation_rules as $sanitation_rule) {
		include $sanitation_rule;
	}
}
