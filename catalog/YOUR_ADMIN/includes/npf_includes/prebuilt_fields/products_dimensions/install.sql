ALTER TABLE products ADD products_dimensions varchar(32) DEFAULT NULL;
ALTER TABLE products ADD products_weight_type ENUM('lbs','kgs') NOT NULL DEFAULT 'lbs' after products_weight;
ALTER TABLE products ADD products_dim_type ENUM('in','cm') NOT NULL DEFAULT 'in' after products_weight_type;
-- ALTER TABLE products ADD products_length DECIMAL(6,2) DEFAULT NULL after products_dim_type;
-- ALTER TABLE products ADD products_width DECIMAL(6,2) DEFAULT NULL after products_length; 
-- ALTER TABLE products ADD products_height DECIMAL(6,2) DEFAULT NULL after products_width;
ALTER TABLE products ADD products_ready_to_ship tinyint(1) NOT NULL DEFAULT 1 after products_height;
ALTER TABLE products ADD products_actual_weight varchar(32) DEFAULT NULL after products_weight;
ALTER TABLE products ADD products_diameter varchar(32) DEFAULT NULL;
INSERT INTO product_type_layout (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, last_modified, date_added, use_function, set_function) VALUES 
(NULL, 'Show Dimensions', 'SHOW_PRODUCT_INFO_DIMENSIONS', '0', 'Show product dimensions on product info page (requires Numinix Product Fields)?', 1, 17, NULL, NOW(), NULL, 'zen_cfg_select_option(array(\'1\', \'0\'),'),
(NULL, 'Show Diameter', 'SHOW_PRODUCT_INFO_DIAMETER', '0', 'Show product diameter on product info page (requires Numinix Product Fields)?', 1, 17, NULL, NOW(), NULL, 'zen_cfg_select_option(array(\'1\', \'0\'),'),
(NULL, 'Show Conversions', 'SHOW_PRODUCT_INFO_CONVERSIONS', '0', 'Show weight and dimension conversions on product info page (requires Numinix Product Fields)?', 1, 17, NULL, NOW(), NULL, 'zen_cfg_select_option(array(\'1\', \'0\'),'),
(NULL, 'Show Smaller Units', 'SHOW_PRODUCT_INFO_SMALLER_UNITS', '0', 'Show weight and dimensions as g/oz? (requires Numinix Product Fields)?', 1, 17, NULL, NOW(), NULL, 'zen_cfg_select_option(array(\'1\', \'0\'),'),
(NULL, 'Show Actual Weight', 'SHOW_PRODUCT_INFO_ACTUAL_WEIGHT', '0', 'Show products actual weight on product info page (requires Numinix Product Fields)?', 1, 17, NULL, NOW(), NULL, 'zen_cfg_select_option(array(\'1\', \'0\'),');