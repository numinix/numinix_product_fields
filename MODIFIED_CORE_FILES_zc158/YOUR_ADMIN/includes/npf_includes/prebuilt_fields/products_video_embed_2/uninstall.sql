-- ALTER TABLE products_description DROP products_video_embed_2;
ALTER TABLE products_description DROP products_video_embed_2_thumbnail;

DELETE FROM product_type_layout WHERE configuration_key IN ('Show Product Video Embed 2');