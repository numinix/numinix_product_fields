ALTER TABLE products DROP COLUMN products_epier;
ALTER TABLE products DROP COLUMN products_ebay;
ALTER TABLE products DROP COLUMN products_ebid;
ALTER TABLE products DROP COLUMN products_sh_na;
ALTER TABLE products DROP COLUMN products_sh_sa;
ALTER TABLE products DROP COLUMN products_sh_eu;
ALTER TABLE products DROP COLUMN products_sh_af;
ALTER TABLE products DROP COLUMN products_sh_as;
ALTER TABLE products DROP COLUMN products_sh_au;
ALTER TABLE products DROP COLUMN products_condition;
ALTER TABLE products DROP COLUMN products_upc;
ALTER TABLE products DROP COLUMN products_isbn;
ALTER TABLE products DROP COLUMN products_weight_type;
ALTER TABLE products DROP COLUMN products_dim_type;
ALTER TABLE products DROP COLUMN products_length;
ALTER TABLE products DROP COLUMN products_width; 
ALTER TABLE products DROP COLUMN products_height;
ALTER TABLE products DROP COLUMN products_ready_to_ship;
ALTER TABLE products DROP COLUMN products_EHF;
ALTER TABLE products DROP COLUMN products_category;
ALTER TABLE products DROP COLUMN products_barcode;
ALTER TABLE products DROP COLUMN products_diameter;
ALTER TABLE products DROP COLUMN products_actual_weight;

DELETE FROM product_type_layout WHERE configuration_key = 'SHOW_PRODUCT_INFO_DIMENSIONS';
DELETE FROM product_type_layout WHERE configuration_key = 'SHOW_PRODUCT_INFO_DIAMETER';
DELETE FROM product_type_layout WHERE configuration_key = 'SHOW_PRODUCT_INFO_CONVERSIONS'; 
DELETE FROM product_type_layout WHERE configuration_key = 'SHOW_PRODUCT_INFO_SMALLER_UNITS'; 
DELETE FROM product_type_layout WHERE configuration_key = 'SHOW_PRODUCT_INFO_ACTUAL_WEIGHT';   

DELETE FROM admin_pages WHERE page_key = 'catalogNPF';
DELETE FROM admin_pages WHERE page_key = 'configNPF';

SET @configuration_group_id=0;
SELECT @configuration_group_id:=configuration_group_id
FROM configuration
WHERE configuration_key= 'NUMINIX_PRODUCT_FIELDS_VERSION'
LIMIT 1;
DELETE FROM configuration WHERE configuration_group_id = @configuration_group_id AND configuration_group_id <> 0;
DELETE FROM configuration_group WHERE configuration_group_id = @configuration_group_id AND configuration_group_id <> 0;