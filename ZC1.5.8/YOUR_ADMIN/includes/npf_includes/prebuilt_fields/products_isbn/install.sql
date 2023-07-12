ALTER TABLE products ADD products_upc varchar(32) NULL default NULL after products_model;
ALTER TABLE products ADD products_isbn varchar(32) NULL default NULL after products_upc;
ALTER TABLE products ADD products_ean varchar(32) NULL default NULL after products_isbn;
ALTER TABLE products ADD products_asin varchar(32) NULL default NULL after products_ean;
INSERT INTO product_type_layout (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, last_modified, date_added, use_function, set_function) VALUES 
(NULL, 'Show UPC', 'SHOW_PRODUCT_INFO_UPC', '0', 'Show product UPC on product info page (requires Numinix Product Fields)?', 1, 17, NULL, NOW(), NULL, 'zen_cfg_select_option(array(\'1\', \'0\'),'),
(NULL, 'Show ISBN', 'SHOW_PRODUCT_INFO_ISBN', '0', 'Show product ISBN on product info page (requires Numinix Product Fields)?', 1, 17, NULL, NOW(), NULL, 'zen_cfg_select_option(array(\'1\', \'0\'),');