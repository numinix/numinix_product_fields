ALTER TABLE `products` ADD `products_price_w` VARCHAR( 150 ) DEFAULT '0' AFTER `products_price`;
ALTER TABLE `products` ADD `wholesale_price` VARCHAR( 150 ) DEFAULT '0' AFTER `products_price`;