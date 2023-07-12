ALTER TABLE products DROP products_upc;
ALTER TABLE products DROP products_ean;
ALTER TABLE products DROP products_asin;

DELETE FROM product_type_layout WHERE configuration_key IN ('SHOW_PRODUCT_INFO_UPC','SHOW_PRODUCT_INFO_ISBN');