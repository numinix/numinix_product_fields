ALTER TABLE products ADD additional_skus varchar(255) DEFAULT NULL;

ALTER TABLE products ADD additional_skus_only tinyint(1) NOT NULL DEFAULT 0;