<?php
$sanitation_rules_dir = DIR_FS_ADMIN . 'includes/init_includes/extra_sanitation_rules';

$sanitation_rules = scandir($sanitation_rules_dir, 1);

foreach ( $sanitation_rules as $sanitation_rule ) {
	include($sanitation_rules_dir . '/' . $sanitation_rule);
}
