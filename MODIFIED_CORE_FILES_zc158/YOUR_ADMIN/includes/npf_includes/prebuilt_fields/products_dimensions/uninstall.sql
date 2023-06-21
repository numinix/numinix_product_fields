ALTER TABLE products DROP products_weight_type;
ALTER TABLE products DROP products_dim_type;
ALTER TABLE products DROP products_length;
ALTER TABLE products DROP products_width;
ALTER TABLE products DROP products_height;
ALTER TABLE products DROP products_ready_to_ship;
ALTER TABLE products DROP products_actual_weight;
ALTER TABLE products DROP products_diameter;

DELETE FROM product_type_layout WHERE configuration_key IN ('SHOW_PRODUCT_INFO_DIMENSIONS','SHOW_PRODUCT_INFO_DIAMETER','SHOW_PRODUCT_INFO_CONVERSIONS','SHOW_PRODUCT_INFO_SMALLER_UNITS','SHOW_PRODUCT_INFO_ACTUAL_WEIGHT');