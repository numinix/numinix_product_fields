<?php

$group = [
	'products_description2',
	'care_instructions',
	'products_video_embed',
	'products_video_embed_2',
];

if (method_exists($sanitizer, 'addSimpleSanitization')) {
	$sanitizer->addSimpleSanitization('PRODUCT_DESC_REGEX', $group);
} elseif (method_exists($sanitizer, 'addSanitizationGroup')) {
	$sanitizer->addSanitizationGroup('PRODUCT_DESC_REGEX', $group);
}
