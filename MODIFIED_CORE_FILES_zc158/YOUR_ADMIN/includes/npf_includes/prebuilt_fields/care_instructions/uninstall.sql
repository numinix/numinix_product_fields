DELETE FROM product_type_layout WHERE configuration_key = 'SHOW_PRODUCT_INFO_CARE_INSTRUCTIONS';
ALTER TABLE products_description DROP care_instructions;